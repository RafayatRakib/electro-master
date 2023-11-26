<?php

namespace App\Jobs;

use App\Mail\AdminOrderConfirmedMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class AdminOrderConfirmedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public  $order;
    public  $currency;
    public function __construct($order,$currency)
    {
        $this->order = $order;
        $this->currency = $currency;
    }

    public function handle(): void
    {
        // Mail::to($this->maildata['email'])->send(new OrderConfirmationMail($this->maildata));
        Mail::to($this->order->email)->send(new AdminOrderConfirmedMail($this->order,$this->currency));
    }
}
