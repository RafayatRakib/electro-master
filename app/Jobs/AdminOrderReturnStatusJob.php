<?php

namespace App\Jobs;

use App\Mail\AdminOrderReturnStatusMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class AdminOrderReturnStatusJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

public $returnData;
    public function __construct($returnData)
    {
        $this->returnData = $returnData;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->returnData->email)->send(new AdminOrderReturnStatusMail($this->returnData->msg));
        
    }
}
