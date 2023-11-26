<?php

namespace App\Models;

use App\Http\Middleware\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employ extends Model
{
    use HasFactory;
    protected $guarded = [];
    //role
    public function RoleName(){
        return 	$this->belongsTo(EmployRole::class,'role_id','id');
    }//end method

    public function salary(){

    }//end method
}
