<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('dashboard');
    }

    public function adminlogged(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->regenerateToken();

        return redirect()->route('index');

    }
}
