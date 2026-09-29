<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index()
    {
        return view('frontend.aboutsus.companyinfo.index');
    }

    public function create()
    {
        return view('frontend.aboutsus.ceomessage.create');
    }

    public function edit($id)
    {
        return view('frontend.aboutsus.ceomessage.edit');
    }

    public function store(Request $request) {}

    public function update(Request $request, $id) {}

    public function destroy($id) {}



    public function indexceo()
    {
        return view('frontend.aboutsus.ceomessage.index');
    }

    public function createceo()
    {
        return view('frontend.aboutsus.ceomessage.create');
    }

    public function editceo($id)
    {
        return view('frontend.aboutsus.ceomessage.edit');
    }

    public function updateceo(Request $request, $id) {}

    public function destroyceo($id) {}



    public function indexmission()
    {
        return view('frontend.aboutsus.mission&vision.index');
    }

    public function createmission()
    {
        return view('frontend.aboutsus.mission&vision.create');
    }

    public function storemission(Request $request){}

    public function editmission($id)
    {
        return view('frontend.aboutsus.mission&vision.edit');
    }

    public function updatemission(Request $request, $id) {}

    public function destroymission($id) {}
}
