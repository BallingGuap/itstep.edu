<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\{Currency, Wallet};

class WalletController extends Controller
{

    public function wallet_main(){
        return 'wallet_main';
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



}
