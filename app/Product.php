<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function stationary_type(){
        return $this->belongsTo(StationaryType::class);
    }

    public function transaction_details(){
        return $this->hasMany(TransactionDetail::class);
    }
}
