<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function transaction_details(){
        return $this->hasMany(TransactionDetail::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
