<?php

namespace App\Mail;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderInvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function build()
    {
        $pdf = Pdf::loadView(
            'emails.invoice-pdf',
            [
                'order' => $this->order,
            ]
        );

        return $this
            ->subject(
                'Invoice #' . $this->order->invoice_number
            )
            ->view('emails.order-invoice')
            ->attachData(
                $pdf->output(),
                $this->order->invoice_number . '.pdf',
                [
                    'mime' => 'application/pdf',
                ]
            );
    }
}