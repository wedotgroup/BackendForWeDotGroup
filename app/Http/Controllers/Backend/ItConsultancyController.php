<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CategoryItcnslt;
use App\Models\SubCategoryItcnslt;
use Illuminate\Http\Request;

use function Laravel\Prompts\select;

class ItConsultancyController extends Controller
{

    public function index()

    {
        $categories = CategoryItcnslt::with(['subcategory'])->get();

        return view('frontend.itconsultancy.category.index', compact("categories"));
    }

    public function create()
    {
        $categories = CategoryItcnslt::select('id', 'name')->get();
        return view(
            'frontend.itconsultancy.category.create',
            compact('categories')
        );
    }

    public function edit($id)
    {
        $category = CategoryItcnslt::findOrFail($id);
        $subcate = SubCategoryItcnslt::findOrFail($id);
        $categories = CategoryItcnslt::select('id', 'name')->get();

     

        return view('frontend.itconsultancy.category.edit', compact("category", 'subcate', 'categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            "name" => "required|string|min:3",
            "slug" => "required|string"
        ]);

        AddData(CategoryItcnslt::class, $data);
        return redirect()->route('admin.itconsultancy.category')->with('success', 'Category Created SuccessFul');
    }

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




    public function storesubcate(Request $request)
    {
        $data = $request->validate([
            "name" => "required|string|min:3",
            "category_id" => "required|string|exists:category_itcnslts,id",
            "slug" => "required|string"
        ]);

        AddData(SubCategoryItcnslt::class, $data);
        return redirect()->route('admin.itconsultancy.category')->with('success', 'SubCategory Created SuccessFul');
    }

    public function editsubcate($id)
    {
        $category = CategoryItcnslt::findOrFail($id);
        $subcate = SubCategoryItcnslt::findOrFail($id);
        $categories = CategoryItcnslt::select('id', 'name')->get();

     
        return view('frontend.itconsultancy.category.edit',compact("category", 'subcate', 'categories'));
    }

    public function createsubcate()
    {
        return view('frontend.itconsultancy.category.create');
    }

    public function updatesubcate(Request $request, $id) {}

    public function destroysubcate($id) {}
}
