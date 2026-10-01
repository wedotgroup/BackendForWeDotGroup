<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class PaymentController extends Controller
{
    public function TabbyPayment(Request $request)
    {
        try {

            $request->validate([

                'payment_method' => 'required|in:tabby',

                'first_name' => 'nullable|string',
                'last_name' => 'nullable|string',
                'name' => 'nullable|string',

                'email' => 'nullable|email',
                'phone' => 'nullable|string',

                'address' => 'nullable|string',
                'city' => 'nullable|string',
                'state' => 'nullable|string',
                'country' => 'nullable|string',
                'zip' => 'nullable|string',

                'cartItems' => 'nullable|array',
                'items' => 'nullable|array',

                'total' => 'nullable|numeric',
                'subtotal' => 'nullable|numeric',
                'discount' => 'nullable|numeric',
                'shipping' => 'nullable|numeric',

                'payment_plan_id' => 'nullable',
                'payment_plan_title' => 'nullable|string',
                'payment_plan_amount' => 'nullable|numeric',
                'payment_plan_fee' => 'nullable|numeric',
                'payment_installments' => 'nullable|integer',
            ]);

            $orderReference =
                'ORD-'.strtoupper(Str::random(10));

            $amount = $request->input('total');

            if ($amount === null || $amount === '') {

                $amount = $request->input('subtotal');
            }

            if ($amount === null || $amount === '') {

                $amount = $request->input('amount');
            }

            $amount = (float) $amount;

            if ($amount <= 0) {

                return response()->json([
                    'success' => false,
                    'message' => 'Invalid payment amount.',
                    'amount' => $amount,
                ], 422);
            }

            $amount = number_format(
                $amount,
                2,
                '.',
                ''
            );

            $firstName = trim(
                (string) $request->input(
                    'first_name',
                    ''
                )
            );

            $lastName = trim(
                (string) $request->input(
                    'last_name',
                    ''
                )
            );

            $customerName = trim(
                $firstName.' '.$lastName
            );

            if (! $customerName) {

                $customerName = $request->input(
                    'name',
                    'Test Customer'
                );
            }

            $customerEmail = $request->input(
                'email',
                'card.success@tabby.ai'
            );

            $customerPhone = $request->input(
                'phone',
                '500000001'
            );

            return $this->createTabbyCheckout(
                $request,
                $orderReference,
                $amount,
                $customerName,
                $customerEmail,
                $customerPhone
            );

        } catch (ValidationException $e) {

            return response()->json([

                'success' => false,

                'message' => 'Validation failed.',

                'errors' => $e->errors(),

            ], 422);

        } catch (\Throwable $e) {

            Log::error(
                'Tabby Payment Error',
                [
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                ]
            );

            return response()->json([

                'success' => false,

                'message' => 'Payment server error.',

                'error' => $e->getMessage(),

            ], 500);
        }
    }

    private function createTabbyCheckout(
        Request $request,
        string $orderReference,
        string $amount,
        string $customerName,
        string $customerEmail,
        string $customerPhone
    ) {

        try {

            $secretKey = env(
                'TABBY_SECRET_KEY'
            );

            $apiUrl = env(
                'TABBY_API_URL'
            );

            if (! $secretKey) {

                return response()->json([

                    'success' => false,

                    'message' => 'TABBY_SECRET_KEY is missing in .env',

                ], 500);
            }

            if (! $apiUrl) {

                return response()->json([

                    'success' => false,

                    'message' => 'TABBY_API_URL is missing in .env',

                ], 500);
            }

            $requestItems = $request->input(
                'cartItems',
                $request->input(
                    'items',
                    []
                )
            );

            $items = [];

            foreach (
                $requestItems as $index => $item
            ) {

                $quantity = (int) (
                    $item['quantity']
                    ?? $item['qty']
                    ?? 1
                );

                if ($quantity < 1) {

                    $quantity = 1;
                }

                $unitPrice = (float) (
                    $item['price']
                    ?? $item['unit_price']
                    ?? $item['amount']
                    ?? 0
                );

                $title =
                    $item['title']
                    ?? $item['name']
                    ?? $item['product_name']
                    ?? 'Product';

                $referenceId = (string) (
                    $item['id']
                    ?? $item['product_id']
                    ?? $item['productId']
                    ?? ($index + 1)
                );

                $items[] = [

                    'title' => $title,

                    'description' => $item['description']
                        ?? 'Product purchase',

                    'quantity' => $quantity,

                    'unit_price' => number_format(
                        $unitPrice,
                        2,
                        '.',
                        ''
                    ),

                    'discount_amount' => '0.00',

                    'reference_id' => $referenceId,

                    'category' => $item['category']
                        ?? 'General',
                ];
            }

            if (empty($items)) {

                $items[] = [

                    'title' => 'Order '.$orderReference,

                    'description' => 'Online purchase',

                    'quantity' => 1,

                    'unit_price' => $amount,

                    'discount_amount' => '0.00',

                    'reference_id' => $orderReference,

                    'category' => 'General',
                ];
            }

            $payload = [

                'payment' => [

                    'amount' => $amount,

                    'currency' => 'AED',

                    'description' => 'Order '.$orderReference,

                    'buyer' => [

                        'phone' => $customerPhone,

                        'email' => $customerEmail,

                        'name' => $customerName,
                    ],

                    'buyer_history' => [

                        'registered_since' => now()
                            ->subYear()
                            ->toIso8601String(),

                        'loyalty_level' => 0,

                        'wishlist_count' => 0,

                        'is_social_networks_connected' => false,

                        'is_phone_number_verified' => false,

                        'is_email_verified' => true,
                    ],

                    'order' => [

                        'tax_amount' => '0.00',

                        'shipping_amount' => number_format(
                            (float) $request->input(
                                'shipping',
                                0
                            ),
                            2,
                            '.',
                            ''
                        ),

                        'discount_amount' => number_format(
                            (float) $request->input(
                                'discount',
                                0
                            ),
                            2,
                            '.',
                            ''
                        ),

                        'updated_at' => now()->toIso8601String(),

                        'reference_id' => $orderReference,

                        'items' => $items,
                    ],

                    'shipping_address' => [

                        'city' => $request->input(
                            'city',
                            'Dubai'
                        ),

                        'address' => $request->input(
                            'address',
                            'Dubai'
                        ),

                        'zip' => $request->input(
                            'zip',
                            '00000'
                        ),
                    ],

                    'meta' => [

                        'order_id' => $orderReference,

                        'customer' => $customerEmail,

                        'payment_plan_id' => $request->input(
                            'payment_plan_id'
                        ),

                        'payment_plan_title' => $request->input(
                            'payment_plan_title'
                        ),

                        'payment_installments' => $request->input(
                            'payment_installments'
                        ),
                    ],
                ],

                'lang' => 'en',

                'merchant_code' => env(
                    'TABBY_MARCHANT_CODE'
                ),

                'merchant_urls' => [

                'success' => url(
                    '/api/tabby/success/'
                    .$orderReference
                ),

                'cancel' => url(
                    '/api/tabby/cancel/'
                    .$orderReference
                ),

                'failure' => url(
                    '/api/tabby/failure/'
                    .$orderReference
                ),
                ],
            ];

            Log::info(
                'Tabby Checkout Request',
                [

                    'order_reference' => $orderReference,

                    'amount' => $amount,

                    'customer_email' => $customerEmail,

                    'payment_plan' => $request->input(
                        'payment_plan_title'
                    ),

                    'items_count' => count($items),
                ]
            );

            $response = Http::withHeaders([

                'Authorization' => 'Bearer '.$secretKey,

                'Accept' => 'application/json',

                'Content-Type' => 'application/json',

            ])
                ->timeout(30)
                ->post(

                    rtrim(
                        $apiUrl,
                        '/'
                    ).'/api/v2/checkout',

                    $payload
                );

            $tabbyResponse =
                $response->json();

            Log::info(
                'Tabby Checkout Response',
                [

                    'status' => $response->status(),

                    'response' => $tabbyResponse,
                ]
            );

            if ($response->failed()) {

                Log::error(
                    'Tabby API Failed',
                    [

                        'order_reference' => $orderReference,

                        'status' => $response->status(),

                        'response' => $tabbyResponse,
                    ]
                );

                return response()->json([

                    'success' => false,

                    'message' => 'Tabby API request failed.',

                    'status' => $response->status(),

                    'error' => $tabbyResponse,

                ], $response->status());
            }

            if (
                isset($tabbyResponse['status'])
                &&
                $tabbyResponse['status']
                === 'rejected'
            ) {

                return response()->json([

                    'success' => false,

                    'message' => 'Tabby payment is not available for this order.',

                    'tabby_response' => $tabbyResponse,

                ], 422);
            }

            $checkoutUrl =

                data_get(
                    $tabbyResponse,
                    'configuration.available_products.installments.0.web_url'
                )

                ??

                data_get(
                    $tabbyResponse,
                    'web_url'
                )

                ??

                data_get(
                    $tabbyResponse,
                    'checkout_url'
                );

            if (! $checkoutUrl) {

                return response()->json([

                    'success' => false,

                    'message' => 'Tabby checkout URL not found.',

                    'tabby_response' => $tabbyResponse,

                ], 422);
            }

            $tabbyPaymentId =
                data_get(
                    $tabbyResponse,
                    'id'
                );

            $tabbyStatus =
                data_get(
                    $tabbyResponse,
                    'status'
                );

            $order = new Order;

            $order->order_reference =
                $orderReference;

            $order->payment_method =
                'tabby';

            $order->payment_status =
                'pending';

            $order->order_status =
                'pending';

            $order->tabby_payment_id =
                $tabbyPaymentId;

            $order->tabby_session_id =
                $tabbyPaymentId;

            $order->tabby_status =
                $tabbyStatus;

            $order->total =
                (float) $amount;

            $order->save();

            return response()->json([

                'success' => true,

                'message' => 'Tabby checkout created successfully.',

                'order_reference' => $orderReference,

                'checkout_url' => $checkoutUrl,

                'payment_url' => $checkoutUrl,

                'tabby' => [

                    'id' => $tabbyPaymentId,

                    'status' => $tabbyStatus,

                    'web_url' => $checkoutUrl,
                ],

            ], 200);

        } catch (\Throwable $e) {

            Log::error(
                'Tabby Checkout Exception',
                [

                    'message' => $e->getMessage(),

                    'file' => $e->getFile(),

                    'line' => $e->getLine(),
                ]
            );

            return response()->json([

                'success' => false,

                'message' => 'Tabby checkout creation failed.',

                'error' => $e->getMessage(),

            ], 500);
        }
    }

    public function TabbySuccess(
        string $orderReference
    ) {

        $order = Order::where(
            'order_reference',
            $orderReference
        )->first();

        if (! $order) {

            return response()->json([

                'success' => false,

                'message' => 'Order not found.',

            ], 404);
        }

        Log::info(
            'Tabby Success Callback',
            [

                'order_reference' => $orderReference,

                'payment_status' => $order->payment_status,
            ]
        );

        return response()->json([

            'success' => true,

            'message' => 'Tabby checkout completed. Payment confirmation pending.',

            'order_reference' => $orderReference,

            'payment_status' => $order->payment_status,

            'order_status' => $order->order_status,

        ]);
    }

    public function TabbyCancel(
        string $orderReference
    ) {

        $order = Order::where(
            'order_reference',
            $orderReference
        )->first();

        if (! $order) {

            return response()->json([

                'success' => false,

                'message' => 'Order not found.',

            ], 404);
        }

        if (
            $order->payment_status === 'pending'
        ) {

            $order->payment_status =
                'cancelled';

            $order->order_status =
                'cancelled';

            $order->save();
        }

        Log::info(
            'Tabby Cancel Callback',
            [

                'order_reference' => $orderReference,

                'payment_status' => $order->payment_status,
            ]
        );

        return response()->json([

            'success' => true,

            'message' => 'Tabby payment cancelled.',

            'order_reference' => $orderReference,

            'payment_status' => $order->payment_status,

            'order_status' => $order->order_status,

        ]);
    }

    public function TabbyFailure(
        string $orderReference
    ) {

        $order = Order::where(
            'order_reference',
            $orderReference
        )->first();

        if (! $order) {

            return response()->json([

                'success' => false,

                'message' => 'Order not found.',

            ], 404);
        }

        if (
            $order->payment_status === 'pending'
        ) {

            $order->payment_status =
                'failed';

            $order->order_status =
                'payment_failed';

            $order->payment_error =
                'Tabby payment failed.';

            $order->save();
        }

        Log::warning(
            'Tabby Failure Callback',
            [

                'order_reference' => $orderReference,
            ]
        );

        return response()->json([

            'success' => false,

            'message' => 'Tabby payment failed.',

            'order_reference' => $orderReference,

            'payment_status' => $order->payment_status,

        ], 422);
    }

    public function TabbyWebhook(
        Request $request
    ) {

        try {

            $payload = $request->all();

            Log::info(
                'Tabby Webhook Received',
                $payload
            );

            $event = strtolower(

                $request->input('event')
                ??
                $request->input('type')
                ??
                ''
            );

            $paymentId =

                data_get(
                    $payload,
                    'id'
                )

                ??

                data_get(
                    $payload,
                    'payment.id'
                )

                ??

                data_get(
                    $payload,
                    'payment_id'
                );

            $referenceId =

                data_get(
                    $payload,
                    'order.reference_id'
                )

                ??

                data_get(
                    $payload,
                    'order_reference'
                )

                ??

                data_get(
                    $payload,
                    'reference_id'
                );

            $order = null;

            if ($referenceId) {

                $order = Order::where(
                    'order_reference',
                    $referenceId
                )->first();
            }

            if (
                ! $order
                &&
                $paymentId
            ) {

                $order = Order::where(
                    'tabby_payment_id',
                    $paymentId
                )->first();
            }
            if (! $order) {

                Log::warning(
                    'Tabby Webhook Order Not Found',
                    [

                        'event' => $event,

                        'payment_id' => $paymentId,

                        'reference_id' => $referenceId,
                    ]
                );

                return response()->json([
                    'success' => true,
                ]);
            }

            if ($paymentId) {

                $order->tabby_payment_id =
                    $paymentId;
            }

            $order->tabby_status =
                $event;

            switch ($event) {

                case 'authorize':

                    $order->payment_status =
                        'authorized';

                    $order->order_status =
                        'processing';

                    break;

                case 'capture':

                    if (
                        $order->payment_status
                        !== 'paid'
                    ) {

                        $order->payment_status =
                            'paid';

                        $order->order_status =
                            'confirmed';

                        $order->paid_at =
                            now();
                    }

                    break;

                case 'close':

                    if (
                        $order->payment_status
                        !== 'paid'
                    ) {

                        $order->payment_status =
                            'cancelled';

                        $order->order_status =
                            'cancelled';
                    }

                    break;

                case 'reject':

                    if (
                        $order->payment_status
                        !== 'paid'
                    ) {

                        $order->payment_status =
                            'failed';

                        $order->order_status =
                            'payment_failed';

                        $order->payment_error =
                            'Tabby payment rejected.';
                    }

                    break;

                case 'expire':

                    if (
                        $order->payment_status
                        !== 'paid'
                    ) {

                        $order->payment_status =
                            'expired';

                        $order->order_status =
                            'cancelled';
                    }

                    break;

                case 'refund':

                    $order->payment_status =
                        'refunded';

                    $order->order_status =
                        'refunded';

                    break;

                case 'update':

                    Log::info(
                        'Tabby Payment Updated',
                        [

                            'order_reference' => $order->order_reference,

                            'payment_id' => $paymentId,
                        ]
                    );

                    break;

                default:

                    Log::info(
                        'Unknown Tabby Webhook Event',
                        [

                            'event' => $event,

                            'order_reference' => $order->order_reference,
                        ]
                    );

                    break;
            }

            $order->save();

            return response()->json([

                'success' => true,

                'message' => 'Webhook processed successfully.',

            ], 200);

        } catch (\Throwable $e) {

            Log::error(
                'Tabby Webhook Error',
                [

                    'message' => $e->getMessage(),

                    'file' => $e->getFile(),

                    'line' => $e->getLine(),
                ]
            );

            return response()->json([

                'success' => false,

                'message' => 'Webhook processing failed.',

            ], 500);
        }
    }
}
