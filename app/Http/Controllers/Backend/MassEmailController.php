<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Jobs\MassMailJob;
use App\Models\NewsLetter;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\MassMailMail;


class MassEmailController extends Controller
{
    public function MailPage(){

        return view('backend.massmail.index');

    }//end method


    public function sendMail(Request $request){

        if(!$request->email){
            toast('Email field must needed.','warning');
            session()->flash('msg','Email field must needed.');
            return redirect()->back();
        }
        $emails = '';
        if($request->all_user && $request->news_letter){
            $usermail = User::where('role','user')->pluck('email')->toArray();
            $newslist = NewsLetter::pluck('email')->toArray();
            $emails = array_merge($usermail,$newslist);
        }elseif($request->all_user  ){
            $emails = User::where('role','user')->pluck('email')->toArray();
        }elseif($request->news_letter  ){
            $emails = NewsLetter::pluck('email')->toArray();
        }else{
            $emails = User::where('role','user')->pluck('email')->toArray();
        }

        $maildata =[
            'email' => $emails,
            'subject' => $request->subject,
            'msg' => $request->email 
        ];

  
        // dd($maildata['email']);
        dispatch(new MassMailJob($maildata));
        // MassMailJob::dispatchNow($mailData);
        // foreach($emails as $email){

        //     Mail::to($email)->send(new MassMailMail($mailData));
        // }
        toast('Email proccesing successfully','success');
        return redirect()->back();

    }//end method




}
