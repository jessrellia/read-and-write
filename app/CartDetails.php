<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartDetails extends Model
{
    public function Product(){
        return $this->belongsTo(Product::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
