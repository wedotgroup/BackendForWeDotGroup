<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ManagementConsultancy;
use Illuminate\Http\Request;

class ManageConsultancyController extends Controller
{
    public function index()
    {
        $whyChooses = ManagementConsultancy::all();

        return view('frontend.homesection.management.index', compact('whyChooses'));
    }

    public function create()
    {
        return view('frontend.homesection.management.create');
    }

    public function editwhychoose($id)
    {
        return view('frontend.homesection.management.edit');
    }

    public function store(Request $request)
    {
        $request->validate([

            'title' => 'nullable|array',
            'title.*' => 'nullable|string',

            'icons' => 'nullable|array',
            'icons.*' => 'nullable|string',

            'company_name' => 'nullable|array',
            'company_name.*' => 'nullable|string',

            'description' => 'nullable|array',
            'description.*' => 'nullable|string',

            'thumbnail' => 'nullable|array',
            'thumbnail.*' => 'nullable|file',
        ]);

        $multipledata = [];

        $titles = $request->title ?? [];
        $icons = $request->icons ?? [];
        $descriptions = $request->description ?? [];
        $company = $request->company_name ?? [];

        foreach ($titles as $key => $title) {

            $thumbnailName = null;

            if ($request->hasFile("thumbnail.$key")) {

                $thumbnail = $request->file("thumbnail.$key");

                $thumbnailName = time().'_'.$key.'_'.$thumbnail->getClientOriginalName();

                $thumbnail->move(
                    public_path('uploads/management/thumbnail'),
                    $thumbnailName
                );
            }

            $multipledata[] = [
                'title' => $title,
                'icon' => $icons[$key] ?? null,
                'description' => $descriptions[$key] ?? null,
                'thumbnail' => $thumbnailName,
                'company_name' => $company[$key],
            ];
        }

        $createdata = ManagementConsultancy::create([
            'multiple_data' => $multipledata,
        ]);
        if ($createdata) {
            return redirect()->route('admin.hero.whychoose')->with('success', 'Data created SuccessFul');

        } else {
            return back()->with('error', 'Data creatation failed');
        }

    }

    public function update(Request $request, $id)
    {
        $request->validate([

            'title' => 'nullable|array',
            'title.*' => 'nullable|string',

            'icons' => 'nullable|array',
            'icons.*' => 'nullable|string',
            'company_name' => 'nullable|array',
            'company_name.*' => 'nullable|string',

            'description' => 'nullable|array',
            'description.*' => 'nullable|string',

            'thumbnail' => 'nullable|array',
            'thumbnail.*' => 'nullable|file',
        ]);

        $whychoose = ManagementConsultancy::findOrFail($id);

        $oldMultipleData = $whychoose->multiple_data ?? [];

        $multipledata = [];

        $titles = $request->title ?? [];
        $icons = $request->icons ?? [];
        $descriptions = $request->description ?? [];
        $company = $request->company_name ?? [];

        foreach ($titles as $key => $title) {

            $thumbnailName = $oldMultipleData[$key]['thumbnail'] ?? null;

            if ($request->hasFile("thumbnail.$key")) {

                // Delete old thumbnail
                if (
                    $thumbnailName &&
                    file_exists(
                        public_path('uploads/whychoose/thumbnail/'.$thumbnailName)
                    )
                ) {
                    unlink(
                        public_path('uploads/whychoose/thumbnail/'.$thumbnailName)
                    );
                }

                $thumbnail = $request->file("thumbnail.$key");

                $thumbnailName = time().'_'.$key.'_'.
                    $thumbnail->getClientOriginalName();

                $thumbnail->move(
                    public_path('uploads/whychoose/thumbnail'),
                    $thumbnailName
                );
            }

            $multipledata[] = [
                'title' => $title,
                'icon' => $icons[$key] ?? null,
                'description' => $descriptions[$key] ?? null,
                'company_name' => $company[$key],
                'thumbnail' => $thumbnailName,
            ];
        }

        $whychoose->update([

            'multiple_data' => $multipledata,
        ]);

        return redirect()
            ->route('admin.hero.whychoose')
            ->with('success', 'Data updated successfully');
    }

    public function destroywhychoose($id)
    {
        $whychoose = ManagementConsultancy::findOrFail($id);

        $multipleData = $whychoose->multiple_data ?? [];

        foreach ($multipleData as $data) {

            if (
                ! empty($data['thumbnail']) &&
                file_exists(
                    public_path('uploads/whychoose/thumbnail/'.$data['thumbnail'])
                )
            ) {
                unlink(
                    public_path('uploads/whychoose/thumbnail/'.$data['thumbnail'])
                );
            }
        }

        $whychoose->delete();

        return redirect()
            ->route('admin.hero.whychoose')
            ->with('success', 'Data deleted successfully');
    }
}
