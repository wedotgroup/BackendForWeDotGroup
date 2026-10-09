<?php

namespace App\Jobs;

use App\Mail\OrderInvoiceMail;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class SendOrderInvoiceJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public int $orderId;

    public function __construct(int $orderId)
    {
        $this->orderId = $orderId;
    }

    public function handle(): void
    {
        $order = Order::with('items')
            ->find($this->orderId);

        if (!$order) {
            return;
        }

        if (!$order->email) {
            return;
        }

       
        if ($order->invoice_sent_at) {
            return;
        }

        

        if (!$order->invoice_number) {

            $order->invoice_number =
                'INV-' .
                now()->format('Ymd') .
                '-' .
                strtoupper(Str::random(6));

            $order->save();
        }

        

        Mail::to($order->email)
            ->send(
                new OrderInvoiceMail($order)
            );

        

        $order->invoice_sent_at = now();

        $order->save();
    }
}