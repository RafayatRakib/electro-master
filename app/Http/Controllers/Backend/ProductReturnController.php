<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Jobs\AdminOrderReturnStatusJob;
use App\Models\Order;
use App\Models\Order_item;
use App\Models\ProductReturn;
use App\Models\ReturnImages;
use App\Models\ReturnReson;
use Carbon\Carbon;
use Illuminate\Http\Request;


class ProductReturnController extends Controller
{

    public function returnReson(){
        $reson =  ReturnReson::paginate(25);
        return view('backend.pages.return.return_reson',compact('reson'));
    }//end method
    
    public function addReturnReson(Request $request){
        $request->validate([
            'return_reson' => 'required'
        ]);
        $reson = new ReturnReson();
        $reson->return_reson =  $request->return_reson;
        $reson->created_at =  Carbon::now();
        $reson->save();
        session()->flash('success','Return reson added succesfuly');
        return redirect()->back();
    }//end method

    public function ReturnStatus($id){
        $reson = ReturnReson::findOrFail($id);
        if($reson->status == 'active'){
            $reson->status = 'inactive';
            $reson->update();
            session()->flash('error','Return reson inactive');
            return redirect()->back();
        }else{
            $reson->status = 'active';
            $reson->update();
            session()->flash('success','Return reson active');
            return redirect()->back();
        }
    }// end method

    public function returnResonEdit($id){
        $reson = ReturnReson::findOrFail($id);
        return view('backend.pages.return.edit_reson',compact('reson'));
    }//end method
    public function resonUpdate(Request $request){
        $reson = ReturnReson::findOrfail($request->reson_id);
        $reson->return_reson =  $request->return_reson;
        $reson->updated_at =  Carbon::now();
        $reson->update();
        session()->flash('success','Return reson updated');
        return redirect()->route('return_reson');
    }//end method
    public function resonDelete(Request $request){
        $reson = ReturnReson::findOrFail($request->delete_id);
        $reson->delete();
        session()->flash('error','Return reson deleted');
        return redirect()->route('return_reson');
    }//end method


    // -------------------------------------------------------------------------------
    public function allReturn(){
      $return = ProductReturn::with('product')->paginate(25);
    return view('backend.pages.return.all_return',compact('return'));
    }//end method

    public function returnDetails($id){
        $return = ProductReturn::with('user')->findOrFail($id);
        // dd($return);
        $product =  Order_item::with('product')->where('user_id',$return->user_id)->where('order_id',$return->order_id)->where('product_id',$return->product_id)->first();
        $images = ReturnImages::where('return_id',$id)->get();
        $order = Order::with('district','upazila')->findOrFail($return->order_id);
        return view('backend.pages.return.return_details',compact('product','return','images','order'));
    }//end method

    public function returnAcc(Request $request){
        // return rejct start
        $return = ProductReturn::with('user','order')->findOrFail($request->return_id);
        if($return->status == 'reject'){
            session()->flash('error','Olready rejected');
            return redirect()->route('all.return');
        }else{
            if($request->return_status == 'reject'){
                $request->validate([
                    'reject_comment' => 'required'
                ]);
                $order = Order::with('district','upazila')->findOrFail($return->order_id);
                $msg = "Your Order number: ". $return->order->order_number. 'should be rejected. Becouse of'. $request->reject_comment;
                $return->admin_note = $msg;
                $return->status = 'reject';
                $return->update();
                $email = $return->order->email;
                $returnData = [
                    'status' => $request->return_status,
                    'msg' => $msg,
                    'email' => $email
                ];
                dispatch(new AdminOrderReturnStatusJob($returnData));
                return redirect()->back();
            //    return view('backend.pages.return.return_acc_note',compact('return','order'));
            
        }
    }

        // return rejct end

        //return accept start
        if($request->return_status == 'accept'){
            $return->accept_date = Carbon::now();
            $return->status = 'accept';
            $return->save();
            dispatch(new AdminOrderReturnStatusJob($request->return_status));
            session()->flash('success','Return accepted');
            return redirect()->route('all.return');
        }

        //return deliverd
        if($request->return_status == 'deliverd'){
            $return->accept_date = Carbon::now();
            $return->status = 'deliverd';
            $return->save();
            session()->flash('success','Return deliverd');
            return redirect()->route('all.return');
        }

    }//end method

    public function RejctOrder(Request $request){
        // dd($request);
        $return = ProductReturn::findOrFail($request->reject_id);

        $return->admin_note = $request->reject_note;
        $return->reject_date = Carbon::now();
        $return->status = 'reject';
        $return->save();
        //        Mail::to('<EMAIL>')->send(new RejectMail());
        //         Notification::route('mail',['<EMAIL>', '<EMAIL>' ])
        //             ->notify((new RejectNotification())->delay(Carbon::now()));
        //            $notification = new RejectNotification();
        //                $notification->delay=Carbon::now();
        //                    $notification->via(['database']);
        //                        $notification->queue(new RejectNotification());
        //dd("ok");
        session()->flash('error','Order reject succesfully!');
        return redirect()->route('all.return');


    }//end method



}