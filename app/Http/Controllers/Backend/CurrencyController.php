<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function currency(){
        $currency = Currency::all();
        return view('backend.pages.currency.currency',compact('currency'));
    }//end method

    public function currencyStore(Request $request){
        $request->validate([
            'currency' => 'required',
            'currency_symbol' => 'required',
        ]);

        $currency = new Currency();
        $currency->currency = $request->currency;
        $currency->currency_symbol = $request->currency_symbol;
        $currency->save();
        session()->flash('success','Currency added succesfully');
        return redirect()->back();
    }//end method

    public function currencyEdit($id){
        $currency = Currency::findOrFail($id);
        return view('backend.pages.currency.currency_edit',compact('currency'));
    }//end method

    public function currencyUpdate(Request $request){
        $request->validate([
            'currency' => 'required',
            'currency_symbol' => 'required',
        ]);

        $currency = Currency::findOrFail($request->currency_id);
        if($request->currency){
            $currency->currency = $request->currency;
        }
        if($request->currency_symbol){
            $currency->currency_symbol = $request->currency_symbol;
        }
        $currency->update();
        session()->flash('success','Currency updated succesfully');
        return redirect()->route('currency');
    }//end method

    public function currencyDelete($id){
        Currency::findOrFail($id)->delete();
        session()->flash('error','Currency deleted succesfully');
        return redirect()->route('currency');
    
    }//end method

}
