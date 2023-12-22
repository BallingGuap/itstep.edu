<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\{Currency, Wallet};

class WalletController extends Controller
{
    public function create_wallet()
    {
        $currencies = Currency::all();
        return view('TEMPLATE', compact('$currencies'));
    }

    public function wallet_main($id)
    {
        $wallet = Wallet::findOrFail($id);
        $currencies = Currency::all(); 
        return view('TEMPLATE', compact('currencies')); 
    }

    public function transfer_create()
    {
        $wallets = Wallet::all(); 
        return view('TEMPLATE', compact('wallets')); 
    }
}
