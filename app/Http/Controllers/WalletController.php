<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\{Currency, Wallet, OutcomeCategory, IncomeCategory, Outcome, Income};

class WalletController extends Controller
{

    public function wallet_main($id)
    {
        $wallet = Wallet::findOrFail($id);
        $currencies = Currency::all();
        $incomes =   $wallet->incomes()->with('category')->get();
        $outcomes =  $wallet->outcomes()->with('category')->get();
        $totalIncome  =  $incomes->sum('amount');
        $totalOutcome = $outcomes->sum('amount');

        $incomeTotalsWithCategory = $incomes->groupBy('category.name')->map(function ($items) {
            return $items->sum('amount');
        });
        $outcomeTotalsWithCategory = $outcomes->groupBy('category.name')->map(function ($items) {
            return $items->sum('amount');
        });
        $incomeTotalsWithCategory = $incomeTotalsWithCategory->toArray();
        $outcomeTotalsWithCategory = $outcomeTotalsWithCategory->toArray();

        return view('wallet.index', compact('currencies','wallet', 'totalIncome', 'totalOutcome', 'incomeTotalsWithCategory', 'outcomeTotalsWithCategory'));
    }

    public function transfer_create($current_wallet_id)
    {
        $wallets = Wallet::where('id', '!=', $current_wallet_id)->get();
        $current_wallet = Wallet::find($current_wallet_id);
        return view('wallet.transfer_create', compact('wallets', 'current_wallet'));
    }

    public function transfer_save(Request $request, $current_wallet_id)
    {
        $validated = $request->validate([
            'wallet_id' => 'required',
            'sum' => 'required|numeric'
        ]);

        $current_wallet = Wallet::find($current_wallet_id);
        $current_wallet_currency = $current_wallet->currency;

        if ($current_wallet->balance - $validated['sum'] >= 0) {
            $to_wallet = Wallet::find($validated['wallet_id']);
            $current_wallet->balance -= $validated['sum'];

            $outcome = new Outcome();
            $outcome->outcome_category_id = 1;
            $outcome->wallet_id = $current_wallet->id;
            $outcome->amount = $validated['sum'];


            $income = new Income();
            $income->income_category_id = 1;
            $income->wallet_id = $to_wallet->id;

            if ($current_wallet_currency->symbol == $to_wallet->currency->symbol) {
                $to_wallet->balance += $validated['sum'];
                $income->amount = $validated['sum'];
            } else {
                $tenge_amount = $validated['sum'] * $current_wallet_currency->exchange_rate_to_tenge;
                $converted_amount = $tenge_amount / $to_wallet->currency->exchange_rate_to_tenge;

                $to_wallet->balance += $converted_amount;
                $income->amount = $converted_amount;
            }

            $outcome->save();
            $income->save();
            $current_wallet->save();
            $to_wallet->save();
            return back();
        } else {
            return back()->withErrors(['sum' => 'Недостаточно средств']);
        }
    }

    public function create_wallet()
    {
        $currencies = Currency::all();
        return view('wallet.create_wallet', compact('currencies'));
    }

    public function save_wallet(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'currency_id' => 'required|numeric',
            'balance' => 'required|numeric|gt:0'
        ]);

        $wallet = new Wallet();
        $wallet->name = $validated['name'];
        $wallet->currency_id = $validated['currency_id'];
        $wallet->balance = $validated['balance'];

        $wallet->save();
        return redirect()->route('main.index');
    }


    public function save_random_outcome($wallet_id)
    {
        $wallet = Wallet::findOrFail($wallet_id);
        $currentBalance = $wallet->balance;
        $randomAmount = random_int(0, $currentBalance);
        $wallet->balance -= $randomAmount;
        $randomCategory = OutcomeCategory::where('id', '!=', 1)->inRandomOrder()->first();
        $outcome = new Outcome;
        $categoryId = 0;
        if ($randomCategory) {
            $categoryId = $randomCategory->id;
        }
        $outcome->outcome_category_id = $categoryId;
        $outcome->wallet_id = $wallet_id;
        $outcome->amount = $randomAmount;
        $outcome->save();
        $wallet->save();
        return back();
    }



    public function save_random_income($wallet_id)
    {
        $wallet = Wallet::findOrFail($wallet_id);
        $currentBalance = $wallet->balance;
        $randomAmount = random_int(0, $currentBalance * 2); //спорный момент, сделал неуточняя
        $wallet->balance += $randomAmount;
        $randomCategory = IncomeCategory::where('id', '!=', 1)->inRandomOrder()->first();
        $income = new Income;
        $categoryId = 0;
        if ($randomCategory) {
            $categoryId = $randomCategory->id;
        }
        $income->income_category_id = $categoryId;
        $income->wallet_id = $wallet_id;
        $income->amount = $randomAmount;
        $income->save();
        $wallet->save();
        return back();
    }



}
