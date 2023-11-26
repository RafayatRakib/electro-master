<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FlashSalesController extends Controller
{
    public function FlashSales(){
        return view('backend.pages.flashSales.index');
    }//end method
}
