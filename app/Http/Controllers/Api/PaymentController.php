<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\SendOrderInvoiceJob;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
   

    public function TabbyPayment(Request $request)
    {
        try {

            $request->validate([

                'payment_method' => 'required|in:tabby',

                'first_name' => 'required|string|max:100',

                'last_name' => 'required|string|max:100',

                'email' => 'required|email',

                'phone' => 'required|string|max:30',

                'address' => 'required|string',

                'city' => 'required|string',

                'country' => 'required|string',

                'total' => 'required|numeric|min:0.01',

            ]);


           

            $orderReference =
                'ORD-' .
                strtoupper(Str::random(10));


            $amount = number_format(
                (float) $request->total,
                2,
                '.',
                ''
            );


            

            $order = Order::create([

                'order_reference' => $orderReference,

                'user_id' => auth()->id(),

                'first_name' => $request->first_name,

                'last_name' => $request->last_name,

                'email' => $request->email,

                'phone' => $request->phone,

                'address' => $request->address,

                'city' => $request->city,

                'state' => $request->state,

                'country' => $request->country,

                'zip' => $request->zip,

                'subtotal' => $request->subtotal ?? $amount,

                'discount' => $request->discount ?? 0,

                'shipping' => $request->shipping ?? 0,

                'total' => $amount,

                'payment_method' => 'tabby',

                'payment_status' => 'pending',

                'order_status' => 'pending',

            ]);


           

            $checkout = $this->createTabbyCheckout(
                $request,
                $order,
                $amount
            );


            if (!$checkout['success']) {

                $order->update([

                    'payment_status' => 'failed',

                    'payment_error' =>
                        $checkout['message'],

                    'order_status' => 'failed',

                ]);

                return response()->json([

                    'success' => false,

                    'message' =>
                        $checkout['message'],

                ], 422);
            }


           

            $order->update([

                'tabby_payment_id' =>
                    $checkout['payment_id'] ?? null,

                'tabby_session_id' =>
                    $checkout['session_id'] ?? null,

                'tabby_status' =>
                    $checkout['status'] ?? 'created',

            ]);


            return response()->json([

                'success' => true,

                'message' =>
                    'Tabby checkout created successfully.',

                'order_id' =>
                    $order->id,

                'order_reference' =>
                    $order->order_reference,

                'payment_id' =>
                    $order->tabby_payment_id,

                'checkout_url' =>
                    $checkout['checkout_url'],

            ]);

        } catch (\Throwable $e) {

            Log::error(
                'Tabby Payment Error',
                [
                    'message' => $e->getMessage(),

                    'line' => $e->getLine(),

                    'file' => $e->getFile(),

                    'trace' => $e->getTraceAsString(),
                ]
            );


            return response()->json([

                'success' => false,

                'message' =>
                    'Unable to create Tabby payment.',

                'error' =>
                    $e->getMessage(),

            ], 500);
        }
    }


    /*
    |--------------------------------------------------------------------------
    | CREATE TABBY CHECKOUT
    |--------------------------------------------------------------------------
    */

    private function createTabbyCheckout(
        Request $request,
        Order $order,
        string $amount
    ): array {

        $frontendUrl = rtrim(
            env('FRONTEND_URL'),
            '/'
        );


        $payload = [

            'payment' => [

                'amount' => $amount,

                'currency' => 'AED',

                'description' =>
                    'Order ' . $order->order_reference,

                'buyer' => [

                    'phone' =>
                        $request->phone,

                    'email' =>
                        $request->email,

                ],

                'buyer_history' => [

                    'registered_since' =>
                        now()->toISOString(),

                    'loyalty_level' => 0,

                ],

                'order' => [

                    'reference_id' =>
                        $order->order_reference,

                    'items' => [],

                ],

                'order_history' => [],

            ],


            'lang' => 'en',


            'merchant_code' =>
                env('TABBY_MARCHANT_CODE', 'AE'),


            'merchant_urls' => [

               

                'success' =>
                    $frontendUrl .
                    '/payment/tabby/success/' .
                    $order->order_reference,

                'cancel' =>
                    $frontendUrl .
                    '/payment/tabby/cancel/' .
                    $order->order_reference,

                'failure' =>
                    $frontendUrl .
                    '/payment/tabby/failed/' .
                    $order->order_reference,

            ],

        ];


        

        $response = Http::withToken(
            env('TABBY_SECRET_KEY')
        )
            ->acceptJson()
            ->post(
                rtrim(
                    env('TABBY_API_URL'),
                    '/'
                ) . '/api/v2/checkout',
                $payload
            );


        

        if ($response->failed()) {

            Log::error(
                'Tabby Checkout Failed',
                [
                    'status' =>
                        $response->status(),

                    'response' =>
                        $response->json(),

                    'payload' =>
                        $payload,
                ]
            );


            return [

                'success' => false,

                'message' =>
                    $response->json(
                        'error',
                        'Tabby checkout failed.'
                    ),

            ];
        }


        $data = $response->json();


        

        $checkoutUrl =
            data_get(
                $data,
                'configuration.available_products.installments.0.web_url'
            )
            ??
            data_get(
                $data,
                'web_url'
            )
            ??
            data_get(
                $data,
                'checkout_url'
            );


        if (!$checkoutUrl) {

            Log::error(
                'Tabby Checkout URL Missing',
                [
                    'response' => $data,
                ]
            );


            return [

                'success' => false,

                'message' =>
                    'Tabby checkout URL was not returned.',

            ];
        }


      
        return [

            'success' => true,

            'checkout_url' =>
                $checkoutUrl,

            'payment_id' =>
                data_get(
                    $data,
                    'payment.id'
                )
                ??
                data_get(
                    $data,
                    'id'
                ),

            'session_id' =>
                data_get(
                    $data,
                    'session.id'
                )
                ??
                data_get(
                    $data,
                    'id'
                ),

            'status' =>
                data_get(
                    $data,
                    'status',
                    'created'
                ),

        ];
    }


   

    public function TabbySuccess(Request $request)
    {
        return response()->json([

            'success' => true,

            'message' =>
                'Payment success page.',

            'payment_id' =>
                $request->payment_id,

            'order_reference' =>
                $request->order_reference,

        ]);
    }


    

    public function TabbyCancel(Request $request)
    {
        return response()->json([

            'success' => false,

            'status' => 'cancelled',

            'message' =>
                'Tabby payment was cancelled.',

            'payment_id' =>
                $request->payment_id,

            'order_reference' =>
                $request->order_reference,

        ]);
    }


    

    public function TabbyFailure(Request $request)
    {
        return response()->json([

            'success' => false,

            'status' => 'failed',

            'message' =>
                'Tabby payment failed.',

            'payment_id' =>
                $request->payment_id,

            'order_reference' =>
                $request->order_reference,

        ]);
    }


   

    public function TabbyWebhook(Request $request)
    {
        try {

           

            Log::info(
                'TABBY WEBHOOK RECEIVED',
                [
                    'payload' =>
                        $request->all(),
                ]
            );


            $data = $request->all();



            $event =
                strtolower(
                    $request->input('event')
                    ??
                    $request->input('type')
                    ??
                    $request->input('status')
                    ??
                    ''
                );


           

            $paymentId =
                data_get(
                    $data,
                    'payment.id'
                )
                ??
                data_get(
                    $data,
                    'id'
                )
                ??
                $request->input('payment_id');


           
            $orderReference =
                data_get(
                    $data,
                    'payment.order.reference_id'
                )
                ??
                data_get(
                    $data,
                    'order.reference_id'
                )
                ??
                $request->input(
                    'order_reference'
                );



            $order = null;


            if ($orderReference) {

                $order = Order::where(
                    'order_reference',
                    $orderReference
                )->first();
            }


            if (!$order && $paymentId) {

                $order = Order::where(
                    'tabby_payment_id',
                    $paymentId
                )->first();
            }


            if (!$order) {

                Log::warning(
                    'Tabby webhook order not found',
                    [
                        'payment_id' =>
                            $paymentId,

                        'order_reference' =>
                            $orderReference,
                    ]
                );


                /*
                | Return 200 so Tabby doesn't
                | unnecessarily keep retrying
                */

                return response()->json([

                    'success' => true,

                    'message' =>
                        'Order not found.',

                ]);
            }



            $order->tabby_payment_id =
                $paymentId
                ??
                $order->tabby_payment_id;

            $order->tabby_status =
                $event
                ??
                $order->tabby_status;


            /*
            |--------------------------------------------------------------------------
            | PAYMENT CAPTURED
            |--------------------------------------------------------------------------
            */

            if (
                in_array(
                    $event,
                    [
                        'capture',
                        'captured',
                        'paid',
                    ],
                    true
                )
            ) {

                /*
                |--------------------------------------------------------------------------
                | Prevent duplicate processing
                |--------------------------------------------------------------------------
                */

                if (
                    $order->payment_status !== 'paid'
                ) {

                    $order->payment_status =
                        'paid';

                    $order->order_status =
                        'confirmed';

                    $order->paid_at =
                        now();

                    $order->payment_error =
                        null;

                    $order->save();

                    SendOrderInvoiceJob::dispatch($order->id);
                }
            }



            elseif (
                in_array(
                    $event,
                    [
                        'authorize',
                        'authorized',
                    ],
                    true
                )
            ) {

                $order->payment_status =
                    'pending';

                $order->order_status =
                    'processing';

                $order->save();
            }


           

            elseif (
                in_array(
                    $event,
                    [
                        'reject',
                        'rejected',
                    ],
                    true
                )
            ) {

                $order->payment_status =
                    'failed';

                $order->order_status =
                    'failed';

                $order->payment_error =
                    'Tabby payment rejected.';

                $order->save();
            }


            

            elseif ($event === 'expire') {

                $order->payment_status =
                    'failed';

                $order->order_status =
                    'expired';

                $order->payment_error =
                    'Tabby payment expired.';

                $order->save();
            }


            elseif ($event === 'close') {

                $order->payment_status =
                    'cancelled';

                $order->order_status =
                    'cancelled';

                $order->save();
            }


            elseif (
                in_array(
                    $event,
                    [
                        'refund',
                        'refunded',
                    ],
                    true
                )
            ) {

                $order->payment_status =
                    'refunded';

                $order->order_status =
                    'refunded';

                $order->save();
            }

            else {

                $order->save();
            }

            return response()->json([

                'success' => true,

                'message' =>
                    'Webhook processed successfully.',

            ], 200);


        } catch (\Throwable $e) {

            Log::error(
                'Tabby Webhook Error',
                [
                    'message' =>
                        $e->getMessage(),

                    'line' =>
                        $e->getLine(),

                    'file' =>
                        $e->getFile(),

                    'trace' =>
                        $e->getTraceAsString(),

                    'payload' =>
                        $request->all(),
                ]
            );


            return response()->json([

                'success' => false,

                'message' =>
                    'Webhook processing failed.',

            ], 500);
        }
    }
}