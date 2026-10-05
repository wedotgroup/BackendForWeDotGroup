<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ManageConsultancy;
use Illuminate\Http\Request;

class ManageConsultancyController extends Controller
{
    public function index()
    {
        $manageclts = ManageConsultancy::all();

        return view('frontend.homesection.management.index', compact('manageclts'));
    }

    public function create()
    {
        return view('frontend.homesection.management.create');
    }

    public function edit($id)
    {
        $manageclt = ManageConsultancy::findOrFail($id);

        return view('frontend.homesection.management.edit', compact('manageclt'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'icons' => 'required|string',
            'title' => 'required|string',
            'description' => 'required|string',
            'company_name' => 'required|string',
            'thumbnail' => 'required|file',
        ]);

        $thumbnail = null;
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $thumbnail = 'uploads/manageclts/'.$filename;
            $file->move(public_path('uploads/manageclts'), $filename);
        }

        $data = [
            'icons' => $request->icons,
            'title' => $request->title,
            'description' => $request->description,
            'thumbnail' => $thumbnail,
            'company_name' => $request->company_name,
        ];

        AddData(ManageConsultancy::class, $data);

        return redirect()->route('admin.manageconsul')->with('success', 'Data created SuccessFul');

    }

    public function update(Request $request, $id)
    {
        $manageclt = ManageConsultancy::findOrFail($id);
        $request->validate([
            'icons' => 'required|string',
            'title' => 'required|string',
            'description' => 'required|string',
            'company_name' => 'required|string',
            'thumbnail' => 'nullable|file',
        ]);
        $thumbnail = $manageclt->thumbnail;

        if ($request->hasFile('thumbnail')) {

            if (! empty($manageclt->thumbnail)) {
                if (file_exists($manageclt->thumbnail)) {
                    unlink(public_path($manageclt->thumbnail));
                }
            }
            $file = $request->file('thumbnail');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $thumbnail = 'uploads/manageclts/'.$filename;
            $file->move(public_path('uploads/manageclts'), $filename);
        }

        $data = [
            'icons' => $request->icons,
            'title' => $request->title,
            'description' => $request->description,
            'thumbnail' => $thumbnail,
            'company_name' => $request->company_name,
        ];

        UpdateData(ManageConsultancy::class, $data, ['id' => $id]);

        return redirect()->route('admin.manageconsul')->with('success', 'Data Updated SuccessFul');
    }

    public function destroy($id)
    {
        $manageclt = ManageConsultancy::findOrFail($id);
        if (! empty($manageclt->thumbnail)) {
            if (file_exists($manageclt->thumbnail)) {
                unlink(public_path($manageclt->thumbnail));
            }
        }
        $manageclt->delete();

        return redirect()->route('admin.manageconsul')->with('success', 'Data delete SuccessFul');

    }
}
