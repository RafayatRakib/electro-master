<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }//end method

    public function district(){
        return $this->belongsTo(District::class,'district_id','id');
    }//end method

    public function upazila(){
        return $this->belongsTo(Upazila::class,'upazila_id','id');
    }//end method

    public function address(){
        return $this->belongsTo(Address::class,'address_id','id');
    }//end method



}
