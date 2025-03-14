<?php

namespace App\Listeners;

use App\Events\ProductStockLow;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\StockCritiqueMail;

class SendLowStockNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ProductStockLow $event): void
    {
        Mail::to('ahmed.benkrara12@gmail.com')->send(new StockCritiqueMail($event->product));
    }
}
