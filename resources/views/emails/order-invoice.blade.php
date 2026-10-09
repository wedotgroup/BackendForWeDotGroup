<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <title>Order Invoice</title>
</head>

<body style="font-family: Arial, sans-serif; background:#f5f5f5; padding:30px;">

    <div style="
        max-width:650px;
        margin:auto;
        background:#ffffff;
        padding:30px;
        border-radius:8px;
    ">

        <h2 style="margin-bottom:10px;">
            Thank you for your order!
        </h2>

        <p>
            Hello {{ $order->first_name }} {{ $order->last_name }},
        </p>

        <p>
            Your payment has been successfully received.
        </p>

        <p>
            Your invoice is attached to this email as a PDF.
        </p>

        <hr>

        <p>
            <strong>Order Reference:</strong>
            {{ $order->order_reference }}
        </p>

        <p>
            <strong>Invoice Number:</strong>
            {{ $order->invoice_number }}
        </p>

        <p>
            <strong>Total Amount:</strong>
            {{ number_format((float) $order->total, 2) }}
        </p>

        <p>
            <strong>Payment Method:</strong>
            {{ strtoupper($order->payment_method) }}
        </p>

        <br>

        <p>
            Regards,<br>
            <strong>We Dot Group</strong>
        </p>

    </div>

</body>
</html>