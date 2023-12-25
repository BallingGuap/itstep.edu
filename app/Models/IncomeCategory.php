<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeCategory extends Model
{
    use HasFactory;
    public function incomes()
    {
        return $this->hasMany('App\Models\Income','income_category_id','id');
    }
}
