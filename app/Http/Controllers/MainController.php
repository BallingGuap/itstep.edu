<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use App\Models\{Currency, Wallet};
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
            'exchangeRateToTenge' => 'required|numeric'
        ]);
        $currency = Currency::find($currency_id);
        $currency->exchangeRateToTenge = $validated['exchangeRateToTenge'];
        $currency->save();

        return redirect()->route('main.index');
    }

    public function index()
    {
        $wallets = Wallet::all();
        $currencyRates = Currency::all();
        return view('main.index', compact('wallets', 'currencyRates'));
    }
}
