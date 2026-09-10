<?php

namespace App\Listeners;

use App\Events\EnquiryEmailEvent;
use App\Mail\EnquieryMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class EnquiryEmailListener implements ShouldQueue
{

    public function __construct()
    {
    }

    public function handle(EnquiryEmailEvent $event): void
    {
        Mail::to('developerabhi2026@gmail.com')->send(new EnquieryMail($event->data));

    }
}
