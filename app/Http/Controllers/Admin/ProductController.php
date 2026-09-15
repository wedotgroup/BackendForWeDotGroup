<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function userlist(){
        $users = User::whereNot('role','admin')->select('name','email','phone','role')->get();
        return view('lists.UserList',compact('users'));
    }
}
