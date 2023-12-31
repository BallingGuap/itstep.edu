<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use App\Models\{Currency, Wallet, IncomeCategory, OutcomeCategory};
use Illuminate\Http\Request;

class MainController extends Controller
{

    public function currency_edit($currency_id)
    {
        if($currency_id == 1){
            return back();
        }
        $currency = Currency::findOrFail($currency_id);
        return view('main.currency_edit', compact('currency'));
    }

    public function currency_update(Request $request, $currency_id)
    {
        if($currency_id == 1){
            return back();
        }
        $validated = $request->validate([
            'exchange_rate_to_tenge' => 'required|numeric'
        ]);
        $currency = Currency::find($currency_id);
        $currency->exchange_rate_to_tenge = $validated['exchange_rate_to_tenge'];
        $currency->save();

        return redirect()->route('main.index');
    }

    public function index()
    {
        $wallets = Wallet::all();
        $currencyRates = Currency::where('id', '!=', 1)->get();
        $walletsBalance = [];
        foreach ($wallets as $wallet) {
            $walletsBalance[$wallet->name] = $wallet->balance * $wallet->currency->exchange_rate_to_tenge;
        }
        return view('main.index', compact('wallets', 'currencyRates', 'walletsBalance'));
    }

    public function categories()
    {
        $incomeCategories = IncomeCategory::all();
        $outcomeCategories = OutcomeCategory::all();
        return view('main.categories_view', compact('incomeCategories', 'outcomeCategories'));
    }

    public function outcomes_create()
    {
        return view('main.outcomes_create'); 
    }
    public function incomes_create()
    {
        return view('main.incomes_create'); 
    }

    public function incomes_save(Request $request){
        $validated = $request->validate([
            'name' => 'required'
        ]);

        $existingCategory = IncomeCategory::where('name', $validated['name'])->first();

        if ($existingCategory) {
            return redirect()->route('main.categories')->with('error', 'Такая категория уже существует');
        }

        $income_category = new IncomeCategory();
        $income_category->name = $validated['name'];
        $income_category->created_at = date("Y-m-d H:i:s");;
        $income_category->updated_at = date("Y-m-d H:i:s");;

        $income_category->save();
        return redirect()->route('main.categories')->with('success', 'Категория добавлена');;
    }

    public function outcomes_save(Request $request){
        $validated = $request->validate([
            'name' => 'required'
        ]);

        $existingCategory = OutcomeCategory::where('name', $validated['name'])->first();

        if ($existingCategory) {
            return redirect()->route('main.categories')->with('error', 'Такая категория уже существует');
        }

        $outcome_category = new OutcomeCategory();
        $outcome_category->name = $validated['name'];
        $outcome_category->created_at = date("Y-m-d H:i:s");;
        $outcome_category->updated_at = date("Y-m-d H:i:s");;

        $outcome_category->save();
        return redirect()->route('main.categories')->with('success', 'Категория добавлена');;
    }

}
