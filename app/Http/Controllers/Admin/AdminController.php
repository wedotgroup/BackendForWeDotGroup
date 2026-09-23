<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ForgetPasswordMail;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|string',
            'password' => 'required|string',

        ]);

        $users = User::where('email', trim($request->email))->first();
        if (! $users) {
            return back()->with('error', 'User Not Found');
        }

        if ($users->role == 'admin') {
            if (Auth::guard('admin')->attempt(['email' => trim($request->email), 'password' => trim($request->password)])) {
                $request->session()->regenerate();

                return redirect()->route('admin.dashboard');
            } else {
                return back()->with('error', 'Authentication failed');
            }
        } else {
            return back()->with('error', 'Your role is invalid');
        }
    }

    public function dashboard()
    {
        $users = CountData(User::class);
        $products = CountData(Product::class);
        $orders = CountData(OrderItem::class);

        $revenue = Payment::sum('amount');

        return view('dashboard', compact(
            'users',
            'products',
            'orders',
            'revenue'
        ));
    }

    public function adminlogged(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->regenerateToken();

        return redirect()->route('index');

    }

    public function forgetpass(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|exists:users,email',
        ]);

        $check = GetSingleData(User::class)->where(['email' => $request->email ,'role'=>'admin']);
        if (! $check) {
            return back()->with('error', 'Your eamil is incorrect');
        }
        $url = env('APP_URL');
        $data = [
            'link' => $url.'/forgetpassword',
        ];

        $send = Mail::to($request->email)->send(new ForgetPasswordMail($data));
        if ($send) {
            return back()->with('success', 'Email send please check you email inbox');
        } else {
            return back()->with('error', 'Something went wrong please try again');
        }

    }
}
