<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReturn extends Model
{
    use HasFactory;
    protected $gurded = [];

    public function order(){
        return $this->belongsTo(Order::class,'order_id','id');
    }// end method

    public function item(){
        return $this->hasMany(Order_item::class,'');
    }//end method

    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }//end method

    public function reson(){
        return $this->belongsTo(ReturnReson::class,'return_reson_id','id');
    }//end method

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }//end method

}
