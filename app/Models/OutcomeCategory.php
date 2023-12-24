<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutcomeCategory extends Model
{
    use HasFactory;
    public function outcomes()
    {
        return $this->hasMany('App\Models\Outcome','outcome_category_id','id');
    }
}
