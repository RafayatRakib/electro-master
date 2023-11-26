<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlashSalesProduct extends Model
{
    use HasFactory;

    public function product(){
       return $this->belongsTo(Product::class,'product_id','id');
    }//end method

    public function flashsale(){
        return $this->belongsTo(FlashSales::class,'flash_sales_id','id');
    }//end method
}
