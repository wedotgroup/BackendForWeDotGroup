<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index(){
        return view('frontend.aboutsus.companyinfo.index');
    }

    public function create(){
        return view('frontend.aboutsus.ceomessage.create');
    }

    public function edit($id){
        return view('frontend.aboutsus.ceomessage.edit');
    }
}
