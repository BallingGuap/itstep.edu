<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
    public function incomes()
    {
        return $this->hasMany(Income::class);
    }
    public function outcomes()
    {
        return $this->hasMany(Outcome::class);
    }
}
