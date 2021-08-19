<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    public function products(){
        return $this->belongsTo(Product::class);
    }

    public function transaction(){
        return $this->hasOne(Transaction::class);
    }
}
