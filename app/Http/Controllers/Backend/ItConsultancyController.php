<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ItConsultancyController extends Controller
{

    public function index()
    {
        return view('frontend.itconsultancy.category.index');
    }

    public function create()
    {
        return view('frontend.itconsultancy.category.create');
    }

    public function edit($id)
    {
        return view('frontend.itconsultancy.category.edit');
    }

    public function store(Request $request) {}

    public function update(Request $request, $id) {}

    public function destroy($id) {}

    // manage services 

    public function indexservice()
    {
        return view("frontend.itconsultancy.manageservice.index");
    }

    public function storeservice(Request $request)
    {
        dd($request->all());
    }

    public function editservice($id)
    {
        return view('frontend.itconsultancy.manageservice.edit');
    }

    public function createservice()
    {
        return view('frontend.itconsultancy.manageservice.create');
    }

    public function updateservice(Request $request, $id) {}

    public function destroyservice($id) {}



    // manage subcategory
    

    public function indexsubcate()
    {
        return view("frontend.itconsultancy.category.index");
    }

    public function storesubcate(Request $request)
    {
        dd($request->all());
    }

    public function editsubcate($id)
    {
        return view('frontend.itconsultancy.category.edit');
    }

    public function createsubcate()
    {
        return view('frontend.itconsultancy.category.create');
    }

    public function updatesubcate(Request $request, $id) {}

    public function destroysubcate($id) {}
}
