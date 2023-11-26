<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    public function allProductStock(){
        $product = Product::where('status','active')->latest()->paginate(15);
        // dd($product);
        return view('backend.pages.inventory.inventory',compact('product'));
    }//end method


    public function WorningStock(){
        $product = Product::where('qty', '<=', DB::raw('qty_warning'))->paginate(15);
        return view('backend.pages.inventory.worning_inventory',compact('product'));
    }//end method

    public function StockDetails($id){
        $inventory = Inventory::where('product_id',$id)->latest()->get();
        $product =  Product::findOrFail($id);
        return view('backend.pages.inventory.inventoryDetails',compact('inventory','product'));
    }//end method




}
