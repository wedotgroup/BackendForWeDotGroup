<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function userlist()
    {
        $users = User::whereNot('role', 'admin')->select('name', 'email', 'phone', 'role')->get();

        return view('lists.UserList', compact('users'));
    }

    public function index()
    {
        return view('admin.products.create');
    }

    public function listing()
    {
        $products = Product::all();

        return view('admin.products.index', compact('products'));
    }

    public function edit($id)
    {
        $product = Product::find($id);

        return view('admin.products.edit', compact('product'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string',
            'top_highlights' => 'nullable|string',
            'category' => 'nullable|string|max:255',
            'currency_code' => 'required|string|max:10',
            'price' => 'required|numeric|min:0',
            'stock_price' => 'nullable|numeric|min:0',
            'rating' => 'nullable|numeric|min:0|max:5',
            'rating_text' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'package_includes' => 'nullable|array',
            'package_includes.*' => 'nullable|string|max:255',
            'cupon_code' => 'nullable|string|max:100',
            'cupon_price' => 'nullable|numeric|min:0',
            'images' => 'file',
        ]);
        $filename = null;
        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('productImg'), $filename);
        }

        $createdata = Product::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'category' => $request->category,
            'currency_code' => $request->currency_code,
            'price' => $request->price,
            'top_highlights' => $request->top_highlights,
            'stock_price' => $request->stock_price,
            'rating' => $request->rating,
            'rating_text' => $request->rating_text,
            'description' => $request->description,
            'package_includes' => json_encode($request->package_includes),
            'cupon_code' => $request->cupon_code,
            'cupon_price' => $request->cupon_price,
            'images' => 'productImg/'.$filename,
        ]);

        if ($createdata) {
            return redirect()->route('admin.product.list')->with('success', 'Product Created SuccessFul');
        } else {
            return back()->with('error', 'Product Creation Failed');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string',
            'top_highlights' => 'nullable|string',
            'category' => 'nullable|string|max:255',
            'currency_code' => 'required|string|max:10',
            'price' => 'required|numeric|min:0',
            'stock_price' => 'nullable|numeric|min:0',
            'rating' => 'nullable|numeric|min:0|max:5',
            'rating_text' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'package_includes' => 'nullable|array',
            'package_includes.*' => 'nullable|string|max:255',
            'cupon_code' => 'nullable|string|max:100',
            'cupon_price' => 'nullable|numeric|min:0',
            'images' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $product = Product::findOrFail($id);

        $imagePath = $product->images;

        if ($request->hasFile('images')) {

            $file = $request->file('images');

            $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $uploadPath = public_path('productImg');

            if (! file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            if ($product->images) {
                $oldImage = public_path($product->images);

                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }
            }

            $file->move($uploadPath, $filename);

            $imagePath = 'productImg/'.$filename;
        }

        $updated = $product->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'category' => $request->category,
            'currency_code' => $request->currency_code,
            'price' => $request->price,
            'top_highlights' => $request->top_highlights,
            'stock_price' => $request->stock_price,
            'rating' => $request->rating,
            'rating_text' => $request->rating_text,
            'description' => $request->description,
            'package_includes' => json_encode($request->package_includes),
            'cupon_code' => $request->cupon_code,
            'cupon_price' => $request->cupon_price,
            'images' => $imagePath,
        ]);

        if ($updated) {
            return redirect()
                ->route('admin.product.list')
                ->with('success', 'Product Updated Successfully');
        }

        return back()
            ->with('error', 'Product Update Failed')
            ->withInput();
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->images) {
            $imagePath = public_path($product->images);

            if (is_file($imagePath)) {
                unlink($imagePath);
            }
        }

        $deleted = $product->delete();

        if ($deleted) {
            return redirect()
                ->route('admin.product.list')
                ->with('success', 'Product Deleted Successfully');
        }

        return back()
            ->with('error', 'Product Delete Failed');
    }
}
