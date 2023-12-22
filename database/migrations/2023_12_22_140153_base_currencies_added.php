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
                'exchange_rate_to_tenge' => 1.0
            )
        );
        DB::table('currencies')->insert(
            array(
                'name' => 'Dollar',
                'symbol' => '$',
                'exchange_rate_to_tenge' => 458.72
            )
        );
        DB::table('currencies')->insert(
            array(
                'name' => 'Euro',
                'symbol' => '€',
                'exchange_rate_to_tenge' => 505.52
            )
        );
        DB::table('currencies')->insert(
            array(
                'name' => 'Ruble',
                'symbol' => '₽',
                'exchange_rate_to_tenge' => 4.96
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
