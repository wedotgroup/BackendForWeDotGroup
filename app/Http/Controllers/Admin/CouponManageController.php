<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponManageController extends Controller
{
    public function index()
    {
        $cuopons = getAll(Coupon::class);

        return view('admin.coupons.index', compact('cuopons'));
    }

    public function create()
    {
        return view('admin.coupons.create');

    }

    public function store(Request $request)
    {

        $validate = $request->validate([
            'code' => 'required|string|unique:coupons,code',
            'type' => 'required|string|in:percentage,fixed',
            'value' => 'required|numeric|min:0',
            'minimum_order_amount' => 'nullable|numeric|min:0',
            'maximum_discount' => 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:1',
            'used_count' => 'nullable|integer|min:0',
            'start_date' => 'required|date',
            'expiry_date' => 'required|date',
            'status' => 'required|in:active,inactive',
        ]);

        $createdata = AddData(Coupon::class, $validate);
        if ($createdata) {
            return redirect()->route('admin.cupons')->with('success', 'Cuopon Created SuccessFully');
        } else {
            return redirect()->route('admin.cupons')->with('error', 'Cuopon Creation Failed');
        }
    }

    public function edit($id)
    {
        $cuopon = GetSingleData(Coupon::class, ['id' => $id]);

        return view('admin.coupons.edit', compact('cuopon'));
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'code' => 'required|string',
            'type' => 'required|string|in:percentage,fixed',
            'value' => 'required|numeric|min:0',
            'minimum_order_amount' => 'nullable|numeric|min:0',
            'maximum_discount' => 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:1',
            'used_count' => 'nullable|integer|min:0',
            'start_date' => 'required|date',
            'expiry_date' => 'required|date',
            'status' => 'required|in:active,inactive',
        ]);

        $data = UpdateData(Coupon::class, $validate, ['id' => $id]);
        if ($data) {
            return redirect()->route('admin.cupons')->with('success', 'Cuopon Updated SuccessFul');
        } else {
            return redirect()->route('admin.cupons')->with('error', 'Cuopon Updated Failed');

        }
    }

    public function destroy($id)
    {
        $delete = DeleteData(Coupon::class, ['id' => $id]);
        if ($delete) {
            return redirect()->route('admin.cupons')->with('success', 'Cuopon Delete SuccessFully');
        } else {
            return redirect()->route('admin.cupons')->with('error', 'Cuopon Deletion Failed');
        }
    }
}
