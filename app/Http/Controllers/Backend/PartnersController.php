<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PartnerLogo;
use Illuminate\Http\Request;

class PartnersController extends Controller
{
    public function index()
    {
        $logosdata = PartnerLogo::first();

        return view('frontend.partners.index', compact('logosdata'));
    }

    public function create()
    {
        return view('frontend.partners.create');
    }

    public function edit($id)
    {
        $logo = PartnerLogo::findOrFail($id);

        return view('frontend.partners.edit', compact('logo'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'logos' => 'required|array',
            'logos.*' => 'required|file|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $uploaded = [];

        if ($request->hasFile('logos')) {
            foreach ($request->file('logos') as $file) {

                $filename = time().'_'.uniqid().'.'.
                            $file->getClientOriginalExtension();

                $file->move(public_path('uploads/logos'), $filename);

                $uploaded[] = $filename;
            }
        }

        PartnerLogo::create([
            'logos' => json_encode($uploaded),
        ]);

        return redirect()->route('admin.partner')->with('success', 'Logos Added Successful');
    }

   public function update(Request $request, $id)
{
    $logo = PartnerLogo::findOrFail($id);

    $request->validate([
        'logos' => 'required|array|min:1',
        'logos.*' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    $oldLogos = $logo->logos ?? [];

    if (!is_array($oldLogos)) {
        $oldLogos = [];
    }

    $uploadPath = public_path('uploads/logos');

    if (!file_exists($uploadPath)) {
        mkdir($uploadPath, 0755, true);
    }

  
    $newLogos = [];

    foreach ($request->file('logos') as $file) {

        $filename = time() . '_' . uniqid() . '.' .
            $file->getClientOriginalExtension();

        $file->move($uploadPath, $filename);

        $newLogos[] = $filename;
    }

  
    $logo->logos = array_merge($oldLogos, $newLogos);

    $logo->save();

    return redirect()
        ->route('admin.partner')
        ->with('success', 'New logos added successfully.');
}


    public function destroy($id)
    {
        $logo = PartnerLogo::findOrFail($id);
        $logodata = $logo->logos ?? [];

        if (! is_array($logodata)) {
            $logodata = [];
        }

        foreach ($logodata as $file) {
            if (is_array($file)) {
                $file = $file['filename'] ?? '';
            }

            if (empty($file)) {
                continue;
            }

            $filePath = public_path(
                'uploads/logos/'.$file
            );

            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        $logo->delete();

        return redirect()
            ->route('admin.partner')
            ->with('success', 'Logos deleted successfully.');
    }
}
