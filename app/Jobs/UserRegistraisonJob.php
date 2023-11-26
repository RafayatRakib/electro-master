<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\userRegistrationMail;

class UserRegistraisonJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $maildata;
    public function __construct($maildata)
    {
        $this->maildata = $maildata;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        
        try {
            Mail::to($this->maildata['email'])->send(new userRegistrationMail($this->maildata));

        } catch (\Exception $exception) {
            // Handle exceptions as needed

            if ($this->attempts() < $this->tries) {
                // Retry the job with an exponential backoff
                $this->release(60 * $this->attempts());
            } else {
                // Log or store the failure details if needed
                $this->fail($exception);
            }
        }
    


    }
}
