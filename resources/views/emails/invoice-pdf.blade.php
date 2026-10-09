<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>
        Invoice {{ $order->invoice_number }}
    </title>

    <style>

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }

        .header {
            width: 100%;
            margin-bottom: 30px;
        }

        .company {
            float: left;
            width: 50%;
        }

        .invoice {
            float: right;
            width: 50%;
            text-align: right;
        }

        .clearfix {
            clear: both;
        }

        h1 {
            margin: 0;
            font-size: 28px;
        }

        h2 {
            margin-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 10px;
        }

        table th {
            background: #f1f1f1;
        }

        .text-right {
            text-align: right;
        }

        .total {
            font-size: 16px;
            font-weight: bold;
        }

        .customer {
            margin-top: 30px;
        }

        .footer {
            margin-top: 50px;
            text-align: center;
            color: #777;
        }

    </style>

</head>

<body>

    <div class="header">

        <div class="company">

            <h2>
                We Dot Group
            </h2>

            <p>
                Technology, Talent & Strategy
            </p>

        </div>

        <div class="invoice">

            <h1>
                INVOICE
            </h1>

            <p>
                <strong>Invoice:</strong>
                {{ $order->invoice_number }}
            </p>

            <p>
                <strong>Date:</strong>
                {{ $order->paid_at?->format('d M Y') }}
            </p>

        </div>

        <div class="clearfix"></div>

    </div>


    <div class="customer">

        <h3>
            Bill To
        </h3>

        <p>

            <strong>
                {{ $order->first_name }}
                {{ $order->last_name }}
            </strong>

            <br>

            {{ $order->email }}

            <br>

            {{ $order->phone }}

            <br>

            {{ $order->address }}

            <br>

            {{ $order->city }}

            @if($order->state)
                , {{ $order->state }}
            @endif

            @if($order->zip)
                - {{ $order->zip }}
            @endif

            <br>

            {{ $order->country }}

        </p>

    </div>


    <table>

        <thead>

            <tr>

                <th>
                    Product
                </th>

                <th>
                    Product ID
                </th>

            </tr>

        </thead>

        <tbody>

            @forelse($order->items as $item)

                <tr>

                    <td>
                        Product #{{ $item->product_id }}
                    </td>

                    <td>
                        {{ $item->product_id }}
                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="2">
                        Order item information unavailable.
                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>


    <table>

        <tr>

            <td>
                Subtotal
            </td>

            <td class="text-right">
                {{ number_format((float) $order->subtotal, 2) }}
            </td>

        </tr>

        <tr>

            <td>
                Discount
            </td>

            <td class="text-right">
                - {{ number_format((float) $order->discount, 2) }}
            </td>

        </tr>

        <tr>

            <td>
                Shipping
            </td>

            <td class="text-right">
                {{ number_format((float) $order->shipping, 2) }}
            </td>

        </tr>

        <tr>

            <td class="total">
                Total
            </td>

            <td class="text-right total">
                {{ number_format((float) $order->total, 2) }}
            </td>

        </tr>

    </table>


    <div class="footer">

        <p>
            Payment Status:
            <strong>{{ strtoupper($order->payment_status) }}</strong>
        </p>

        <p>
            Thank you for shopping with We Dot Group.
        </p>

    </div>

</body>

</html>