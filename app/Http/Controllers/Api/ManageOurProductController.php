<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class ManageOurProductController extends Controller
{
    public function Products()
    {
        try {
            $products = Product::select('title', 'price', 'id', 'top_highlights', 'category', 'currency_code', 'images')->get();
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

    public function ProductDetails($id)
    {
        try {
            $id = trim($id);
            $products = Product::find($id);
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

    public function RemoveCart($user_id, $product_id)
    {
        try {
            $card = Cart::where('user_id', $user_id)->where('product_id', $product_id)->first();
            if (! $card) {
                return response()->json([
                    'status' => false,
                    'message' => 'Data Not Found',
                ], 404);
            }
            $card->delete();
            if ($card) {
                return response()->json([
                    'message' => 'Remove Your Add to cart items ',
                    'status' => true,
                    'data' => $card,
                ]);
            } else {
                return response()->json([
                    'message' => 'Deletion Failed',
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

    public function MyCartItems($user_id)
    {
        try {
            $card = Cart::with(['product'])->where('user_id', $user_id)->get();
             if (! $card) {
                return response()->json([
                    'status' => false,
                    'message' => 'Data Not Found',
                ], 404);
            }
            
            if ($card) {
                return response()->json([
                    'message' => 'Your Add to cart items',
                    'status' => true,
                    'data' => $card,
                ]);
            } else {
                return response()->json([
                    'message' => 'Cart Items Not Found',
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
}
