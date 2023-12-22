<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBaseCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('income_categories')->insert(
            array(
                'name' => 'incoming transfer'
            )
        );
        DB::table('outcome_categories')->insert(
            array(
                'name' => 'outcoming transfer'
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
        DB::table('income_categories')->delete();
        DB::table('outcome_categories')->delete();
    }
}
