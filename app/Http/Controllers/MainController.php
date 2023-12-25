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
        $currency = Currency::findOrFail($currency_id);
        return view('main.currency_edit',compact('currency'));
    }

    public function currency_update(Request $request, $currency_id)
    {
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
        $currencyRates = Currency::all();
        return view('main.index', compact('wallets', 'currencyRates'));
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

        $income_category = new IncomeCategory();
        $income_category->name = $validated['name'];
        $income_category->created_at = date("Y-m-d H:i:s");;
        $income_category->updated_at = date("Y-m-d H:i:s");;

        $income_category->save();
        return redirect()->route('main.index');
    }

    public function outcomes_save(Request $request){
        $validated = $request->validate([
            'name' => 'required'
        ]);

        $outcome_category = new OutcomeCategory();
        $outcome_category->name = $validated['name'];
        $outcome_category->created_at = date("Y-m-d H:i:s");;
        $outcome_category->updated_at = date("Y-m-d H:i:s");;

        $outcome_category->save();
        return redirect()->route('main.index');
    }

}
