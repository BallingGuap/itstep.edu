<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BaseCurrenciesAdded extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('currencies')->insert(
            array(
                'name' => 'Tenge',
                'symbol' => '₸',
                'exchangeRateToTenge' => 1.0
            )
        );
        DB::table('currencies')->insert(
            array(
                'name' => 'Dollar',
                'symbol' => '$',
                'exchangeRateToTenge' => 458.72
            )
        );
        DB::table('currencies')->insert(
            array(
                'name' => 'Euro',
                'symbol' => '€',
                'exchangeRateToTenge' => 505.52
            )
        );
        DB::table('currencies')->insert(
            array(
                'name' => 'Ruble',
                'symbol' => '₽',
                'exchangeRateToTenge' => 4.96
            )
        );
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('currencies')->delete();
    }
}
