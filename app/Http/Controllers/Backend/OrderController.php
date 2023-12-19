<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Jobs\AdminOrderConfirmedJob;
use App\Jobs\AdminOrderDeleveryJob;
use App\Jobs\AdminOrderShipdeJob;
use App\Jobs\OrderConfirmationJob;
use App\Models\Currency;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Order_item;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Carbon;
use App\Models\Address;
class OrderController extends Controller
{
    public function AllOrder(){
        $order = Order::latest()->paginate(25);
        return view('backend.pages.order.all',compact('order'));
    }//end method

    public function OrderView($id){
        $id =  decrypt($id);
        $order = Order::findOrFail($id);
        $order_item =  Order_item::where('order_id',$id)->get();
        $currency = Currency::where('status','active')->first();
        return view('backend.pages.order.order_details',compact('order','order_item','currency'));
    }//end method

    public function Invoice($id){
        $order = Order::findOrFail($id);
        $order_item =  Order_item::where('order_id',$id)->get();
        $pdf = Pdf::loadView('backend.pages.invoice', compact('order','order_item'))->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('order_invoice'.$id.'.pdf');

    }// end method

    public function order_status(Request $request){
        $request->validate([
            'order_status' => 'required'
        ]);
        $order = Order::findOrFail($request->order_id);
       $currency = Currency::where('status','active')->first();

        if($request->order_status == 'confirmed'){
            if($order->status == 'processing'){
                $order->confirmed_date = Carbon::now();
                $order->status = 'confirmed';
                $order->confirmed_date = Carbon::now();
                $order->processing_date = Carbon::now();
                $order->update();

                dispatch(new AdminOrderConfirmedJob($order,$currency));
                session()->flash('success','Order Confiromed successfully!');
                return redirect()->back();

            }
                session()->flash('error','Somthing is wrong!, call to devoloper');
                return redirect()->back();
        }

        if($request->order_status == 'picked'){
            if($order->status == 'confirmed'){

                $order->picked_date = Carbon::now();
                $order->status = 'picked';
                $order->update();
                session()->flash('success','Order status change to picked');
                return redirect()->back();
            }
            session()->flash('error','Somthing is wrong!, call to devoloper');
            return redirect()->back();
        }

        
        if($request->order_status == 'shiped'){
            // if($order->status == 'picked'){

                if(!$order->confirmed_date ){
                    $order->confirmed_date = Carbon::now();
                }
                if(!$order->picked_date){
                    $order->picked_date = Carbon::now();
                }
                $order->shipped_date = Carbon::now();
                
                $order->status = 'shiped';
                $order->update();
                dispatch(new AdminOrderShipdeJob($order));

                session()->flash('success','Order status change to shiped');
                return redirect()->back();
            // }
            session()->flash('error','Somthing is wrong!, call to devoloper');
            return redirect()->back();
        }


        if($request->order_status == 'delivered'){
            // if($order->status == 'shiped'){

                if(!$order->confirmed_date ){
                    $order->confirmed_date = Carbon::now();
                }
                if(!$order->picked_date){
                    $order->picked_date = Carbon::now();
                }
                if(!$order->shipped_date){
                    $order->shipped_date = Carbon::now();
                }

                $order->delivered_date = Carbon::now();
                $order->status = 'delivered';
                $order->update();
                dispatch(new AdminOrderDeleveryJob($order));
                session()->flash('success','Order status change to delivered');
                return redirect()->back();
            // }                
            session()->flash('error','Somthing is wrong!, call to devoloper');
            return redirect()->back();
        }

        // cancle
        // if($request->order_status == 'confirmed'){
        //     if($order->status == 'processing'){
        //         $order->confirmed_date = Carbon::now();
        //         $order->status = 'confirmed';
        //         $order->update();
        //     }
        // }


    }//end method















}
