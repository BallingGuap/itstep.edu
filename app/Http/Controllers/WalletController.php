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
        return view('wallet.index', compact('currencies')); 
    }

    public function transfer_create($current_wallet_id)
    {
        $wallets = Wallet::where('id', '!=', $current_wallet_id)->get(); 
        return view('wallet.transfer.create', compact('wallets')); 
    }

    public function create_wallet(){
        $currencies = Currency::all();
        return view('wallet.create_wallet',compact('currencies'));
    }

    public function save_wallet(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'currency_id' => 'required|numeric',
            'balance' => 'required|numeric'
        ]);

        $wallet = new Wallet();
        $wallet->name = $validated['name'];
        $wallet->currency_id = $validated['currency_id'];
        $wallet->balance = $validated['balance'];

        $wallet->save();
        return redirect()->route('main.index');
    }


    public function save_random_outcome($wallet_id){
        $wallet = Wallet::findOrFail($wallet_id);
        $currentBalance = $wallet->balance;
        $randomAmount = random_int(1, $currentBalance);
        $randomCategory = OutcomeCategory::inRandomOrder()->first();
        $outcome = new Outcome;
        $outcome->outcome_category_id = $randomCategory->id;
        $outcome->wallet_id = $wallet_id;
        $outcome->amount = $randomAmount;
        $outcome->save();
        return redirect()->route('main.index');
    }


    
    public function save_random_icome($wallet_id){
        $wallet = Wallet::findOrFail($wallet_id);
        $currentBalance = $wallet->balance;
        $randomAmount = random_int(1, $currentBalance*2);//спорный момент, сделал неуточняя
        $randomCategory = IncomeCategory::inRandomOrder()->first();
        $income = new Income;
        $income->income_category_id = $randomCategory->id;
        $income->wallet_id = $wallet_id;
        $income->amount = $randomAmount;
        $income->save();
        return redirect()->route('main.index');
    }



}
