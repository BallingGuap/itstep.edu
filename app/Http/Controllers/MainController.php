<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use App\Models\Currency;

class MainController extends Controller
{

    public function currency_edit($currency_id)
    {
        $currency = Currency::findOrFail($currency_id);
        return compact('currency');
    }
}
