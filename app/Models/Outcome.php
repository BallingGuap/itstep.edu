<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outcome extends Model
{
    use HasFactory;
    public function category()
    {
        return $this->belongsTo('App\Models\OutcomeCategory', 'outcome_category_id', 'id');
    }
    public function wallet()
    {
        return $this->belongsTo(wallet::class);
    }
}
