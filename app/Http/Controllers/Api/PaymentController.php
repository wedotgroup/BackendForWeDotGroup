<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function Order(Request $request)
    {
        return response()->json([
            'message' => 'Order data here',
            'data' => $request->all(),
        ]);
    }
}
