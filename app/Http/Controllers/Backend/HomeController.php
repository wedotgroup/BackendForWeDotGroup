<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.homesection.hero.index');
    }

    public function create()
    {
        return view('frontend.homesection.hero.create');
    }

    public function edit($id)
    {
        return view('frontend.homesection.hero.edit');
    }

    public function store(Request $request) {}

    public function update(Request $request, $id) {}

    public function destroy($id) {}


    public function indexwhychoose(){
        return view('frontend.homesection.whychooseus.index');
    }

    public function createwhychoose(){
        return view('frontend.homesection.whychooseus.create');
    }

    public function editwhychoose($id){
        return view('frontend.homesection.whychooseus.edit');
    }

    public function storewhychoose(Request $request){}

    public function updatewhychoose(Request $request,$id){}

    public function destroywhychoose($id){}
}
