<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;
    public function category()
    {
        return $this->belongsTo('App\Models\IncomeCategory', 'income_category_id', 'id');
    }
    public function wallet()
    {
        return $this->belongsTo(wallet::class);
    }
}
