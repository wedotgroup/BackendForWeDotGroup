<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ManageOurProductController extends Controller
{
    public function Products()
    {
        try {
            $products = Product::select('title', 'price', 'id', 'top_highlights', 'category', 'currency_code', 'images', 'slug')->get();
            if ($products) {
                return response()->json([
                    'message' => 'Product lists here',
                    'status' => true,
                    'data' => $products,
                ]);
            } else {
                return response()->json([
                    'message' => 'Product Not Foound',
                    'status' => false,
                    'data' => [],
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something wend wrong',
                'status' => false,
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function ProductDetails($slug)
    {
        try {
            $slug = trim($slug);
            $products = Product::where('slug', $slug)->first();
            $products->package_includes = json_decode($products->package_includes);
            if ($products) {
                return response()->json([
                    'message' => 'Product details here',
                    'status' => true,
                    'data' => $products,
                ]);
            } else {
                return response()->json([
                    'message' => 'Product Not Foound',
                    'status' => false,
                    'data' => [],
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something wend wrong',
                'status' => false,
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function AddToCart(Request $request, $user_id)
    {
        try {
            $user_id = trim($user_id);
            $product_id = trim($request->product_id);

            $product = Product::where('id', $product_id)->first();

            if (! $product) {
                return response()->json([
                    'status' => false,
                    'message' => 'Product not found',
                ], 404);
            }

            $checkProduct = Cart::where('user_id', $user_id)
                ->where('product_id', $product_id)
                ->first();

            if ($checkProduct) {

                $checkProduct->update([
                    'quentity' => $checkProduct->quentity + 1,
                    'price' => $checkProduct->price + $product->price,
                ]);

                return response()->json([
                    'status' => true,
                    'message' => 'Product quantity increased',
                    'data' => $checkProduct,
                ]);
            }

            $cart = Cart::create([
                'user_id' => $user_id,
                'product_id' => $product_id,
                'quentity' => 1,
                'price' => $product->price,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Product added to cart',
                'data' => $cart,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something wend wrong',
                'status' => false,
                'error' => $e->getMessage(),
            ]);
        }

    }

    public function MyCartItems(Request $request)
    {
        try {

            $user = $request->user();

            if (! $user) {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthenticated',
                ], 401);
            }

            $cart = Cart::with('product')
                ->where('user_id', $user->id)
                ->get();

            return response()->json([
                'status' => true,
                'message' => 'Your cart items fetched successfully',
                'data' => $cart,
            ], 200);

        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
            ], 500);
        }
    }

    public function updateCart(Request $request, $id)
    {
        try {

            $request->validate([
                'quentity' => 'required|integer|min:1',
            ]);

            $user = $request->user();

            $cart = Cart::with('product')
                ->where('id', $id)
                ->where('user_id', $user->id)
                ->first();

            if (! $cart) {
                return response()->json([
                    'status' => false,
                    'message' => 'Cart item not found',
                ], 404);
            }

            if (! $cart->product) {
                return response()->json([
                    'status' => false,
                    'message' => 'Product not found',
                ], 404);
            }

            $quantity = (int) $request->quentity;

            // Product ka current unit price
            $unitPrice = (float) $cart->product->price;

            // Total price
            $totalPrice = $unitPrice * $quantity;

            // Update cart
            $cart->update([
                'quentity' => $quantity,
                'price' => $totalPrice,

            ]);

            $cart->load('product');

            return response()->json([
                'status' => true,
                'message' => 'Cart quantity and price updated successfully',
                'data' => $cart,
            ], 200);

        } catch (ValidationException $e) {

            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);

        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function removeCart(Request $request, $id)
    {
        try {

            $user = $request->user();

            $cart = Cart::where('id', $id)
                ->where('user_id', $user->id)
                ->first();

            if (! $cart) {
                return response()->json([
                    'status' => false,
                    'message' => 'Cart item not found',
                ], 404);
            }

            $cart->delete();

            return response()->json([
                'status' => true,
                'message' => 'Cart item removed successfully',
            ], 200);

        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function clearCart(Request $request)
    {
        try {

            $user = $request->user();

            $deleted = Cart::where('user_id', $user->id)->delete();

            return response()->json([
                'status' => true,
                'message' => 'Cart cleared successfully',
                'deleted_items' => $deleted,
            ], 200);

        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function ApplyCuopon(Request $request)
    {
        try {

            $request->validate([
                'cuoponcode' => 'required|string',
                'cart_total' => 'required|numeric|min:0',
            ]);

            $getcode = strtoupper(trim($request->cuoponcode));

            $coupon = Coupon::where('code', $getcode)
                ->where('status', 'active')
                ->first();

            if (! $coupon) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid coupon code.',
                ], 422);
            }

            if (
                ! empty($coupon->start_date) &&
                now()->lt($coupon->start_date)
            ) {
                return response()->json([
                    'status' => false,
                    'message' => 'This coupon is not active yet.',
                ], 422);
            }

            if (
                ! empty($coupon->expiry_date) &&
                now()->gt($coupon->expiry_date)
            ) {
                return response()->json([
                    'status' => false,
                    'message' => 'This coupon has expired.',
                ], 422);
            }

            if (
                ! empty($coupon->usage_limit) &&
                $coupon->used_count >= $coupon->usage_limit
            ) {
                return response()->json([
                    'status' => false,
                    'message' => 'Coupon usage limit has been reached.',
                ], 422);
            }

            $cartTotal = (float) $request->cart_total;

            if (
                ! empty($coupon->minimum_order_amount) &&
                $cartTotal < $coupon->minimum_order_amount
            ) {
                return response()->json([
                    'status' => false,
                    'message' => 'Minimum order amount is '.
                        $coupon->minimum_order_amount,
                ], 422);
            }

            if ($coupon->type === 'percentage') {

                $discount = ($cartTotal * $coupon->value) / 100;

                if (
                    ! empty($coupon->maximum_discount) &&
                    $discount > $coupon->maximum_discount
                ) {
                    $discount = (float) $coupon->maximum_discount;
                }

            } else {

                $discount = (float) $coupon->value;

                if ($discount > $cartTotal) {
                    $discount = $cartTotal;
                }
            }

            $discount = round($discount, 2);

            $finalTotal = round(
                $cartTotal - $discount,
                2
            );

            return response()->json([
                'status' => true,
                'message' => 'Coupon applied successfully.',
                'data' => [
                    'id' => $coupon->id,
                    'code' => $coupon->code,
                    'type' => $coupon->type,
                    'value' => $coupon->value,
                    'discount' => $discount,
                    'cart_total' => $cartTotal,
                    'final_total' => $finalTotal,
                ],
            ], 200);

        } catch (ValidationException $e) {

            return response()->json([
                'status' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);

        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong.',
                'errors' => $e->getMessage(),
            ], 500);
        }
    }
}
