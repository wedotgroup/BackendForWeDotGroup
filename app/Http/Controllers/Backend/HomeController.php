<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use App\Models\WhyChooseUs;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $heros = HeroSection::all();

        return view('frontend.homesection.hero.index', compact('heros'));
    }

    public function create()
    {
        return view('frontend.homesection.hero.create');
    }

    public function edit($id)
    {
        $hero = HeroSection::find($id);

        return view('frontend.homesection.hero.edit', compact('hero'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'badges' => 'nullable|array',
            'badges.*' => 'nullable',

            'hero_title' => 'required|string|min:3',
            'hero_heading' => 'required|string|min:3',
            'description' => 'nullable',

            'button_one' => 'nullable|string',
            'link_one' => 'nullable|string',

            'button_two' => 'nullable|string',
            'link_tow' => 'nullable|string',

            'extra_lists' => 'nullable|array',
            'extra_lists.*' => 'nullable|string',
            'video_file' => 'nullable|file|mimes:mp4,mov,avi,webm|max:102400',
            'list_items_title' => 'nullable|array',
            'list_items_title.*' => 'nullable|string',

            'list_items_value' => 'nullable|array',
            'list_items_value.*' => 'nullable|string',
        ]);

        $herolist = [];
        foreach ($request->list_items_title as $key => $title) {
            $herolist[] = [
                'title' => $title,
                'value' => $request->list_items_value[$key],
            ];
        }

        $filename = '';
        if ($request->hasFile('video_file')) {
            $file = $request->file('video_file');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/hero'), $filename);
        }

        $data = [
            'hero_title' => $request->hero_title,
            'hero_heading' => $request->hero_heading,
            'description' => $request->description,

            'button_one' => $request->button_one,
            'link_one' => $request->link_one,

            'button_two' => $request->button_two,
            'video_file' => 'uploads/hero/'.$filename,
            'link_tow' => $request->link_tow,
            'badges' => json_encode($request->badges),
            'extra_lists' => json_encode($request->extra_lists),
            'list_items' => json_encode($herolist),
        ];

        $datacreate = AddData(HeroSection::class, $data);
        if ($datacreate) {
            return redirect()->route('admin.hero')->with('success', 'Hero section created successful');
        } else {
            return back()->with('error', 'Creation Failed');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'badges' => 'nullable|array',
            'badges.*' => 'nullable',

            'hero_title' => 'required|string|min:3',
            'hero_heading' => 'required|string|min:3',
            'description' => 'nullable',

            'button_one' => 'nullable|string',
            'link_one' => 'nullable|string',

            'button_two' => 'nullable|string',
            'link_tow' => 'nullable|string',

            'extra_lists' => 'nullable|array',
            'extra_lists.*' => 'nullable|string',

            'video_file' => 'nullable|file|mimes:mp4,mov,avi,webm|max:102400',

            'list_items_title' => 'nullable|array',
            'list_items_title.*' => 'nullable|string',

            'list_items_value' => 'nullable|array',
            'list_items_value.*' => 'nullable|string',
        ]);

        $herolist = [];

        foreach ($request->list_items_title ?? [] as $key => $title) {

            $herolist[] = [
                'title' => $title,
                'value' => $request->list_items_value[$key] ?? null,
            ];
        }

        $hero = HeroSection::findOrFail($id);

        $videoPath = $hero->video_file;

        if ($request->hasFile('video_file')) {

            // Delete old video
            if ($hero->video_file) {

                $oldVideo = public_path($hero->video_file);

                if (file_exists($oldVideo)) {
                    unlink($oldVideo);
                }
            }

            $file = $request->file('video_file');

            $filename = time().'.'.$file->getClientOriginalExtension();

            $file->move(
                public_path('uploads/hero'),
                $filename
            );

            $videoPath = 'uploads/hero/'.$filename;
        }

        $data = [

            'hero_title' => $request->hero_title,

            'hero_heading' => $request->hero_heading,

            'description' => $request->description,

            'button_one' => $request->button_one,

            'link_one' => $request->link_one,

            'button_two' => $request->button_two,

            'link_tow' => $request->link_tow,

            'video_file' => $videoPath,

            'badges' => json_encode($request->badges ?? []),

            'extra_lists' => json_encode($request->extra_lists ?? []),

            'list_items' => json_encode($herolist),
        ];

        $hero->update($data);

        return redirect()
            ->route('admin.hero')
            ->with('success', 'Hero section updated successfully');
    }

    public function destroy($id)
    {
        $getdata = HeroSection::find($id);

        $getdata->delete();

        return back()->with('success', 'Data deleted successful');
    }

    public function indexwhychoose()
    {
        $whyChooses = WhyChooseUs::all();
        return view('frontend.homesection.whychooseus.index',compact('whyChooses'));
    }

    public function createwhychoose()
    {
        return view('frontend.homesection.whychooseus.create');
    }

    public function editwhychoose($id)
    {
        return view('frontend.homesection.whychooseus.edit');
    }

    public function storewhychoose(Request $request)
    {
        $request->validate([
            'top_heading' => 'nullable|string',
            'top_des' => 'nullable|string',

            'title' => 'nullable|array',
            'title.*' => 'nullable|string',

            'icons' => 'nullable|array',
            'icons.*' => 'nullable|string',

            'description' => 'nullable|array',
            'description.*' => 'nullable|string',

            'pdf_image' => 'nullable|array',
            'pdf_image.*' => 'nullable|file',

            'thumbnail' => 'nullable|array',
            'thumbnail.*' => 'nullable|file',
        ]);

        $topdata = [
            'top_heading' => $request->top_heading,
            'top_des' => $request->top_des,
        ];

        $multipledata = [];

        $titles = $request->title ?? [];
        $icons = $request->icons ?? [];
        $descriptions = $request->description ?? [];

        foreach ($titles as $key => $title) {

            $pdfImageName = null;
            $thumbnailName = null;

            if ($request->hasFile("pdf_image.$key")) {

                $pdfImage = $request->file("pdf_image.$key");

                $pdfImageName = time().'_'.$key.'_'.$pdfImage->getClientOriginalName();

                $pdfImage->move(
                    public_path('uploads/whychoose/pdf'),
                    $pdfImageName
                );
            }

            if ($request->hasFile("thumbnail.$key")) {

                $thumbnail = $request->file("thumbnail.$key");

                $thumbnailName = time().'_'.$key.'_'.$thumbnail->getClientOriginalName();

                $thumbnail->move(
                    public_path('uploads/whychoose/thumbnail'),
                    $thumbnailName
                );
            }

            $multipledata[] = [
                'title' => $title,
                'icon' => $icons[$key] ?? null,
                'description' => $descriptions[$key] ?? null,
                'pdf_image' => $pdfImageName,
                'thumbnail' => $thumbnailName,
            ];
        }

        $createdata = WhyChooseUs::create([
            'top_content' => $topdata,
            'multiple_data' => $multipledata,
        ]);
        if ($createdata) {
            return redirect()->route('admin.hero.whychoose')->with('success', 'Data created SuccessFul');

        } else {
            return back()->with('error', 'Data creatation failed');
        }

    }

    public function updatewhychoose(Request $request, $id)
    {
        $request->validate([
            'top_heading' => 'nullable|string',
            'top_des' => 'nullable|string',

            'title' => 'nullable|array',
            'title.*' => 'nullable|string',

            'icons' => 'nullable|array',
            'icons.*' => 'nullable|string',

            'description' => 'nullable|array',
            'description.*' => 'nullable|string',

            'pdf_image' => 'nullable|array',
            'pdf_image.*' => 'nullable|file',

            'thumbnail' => 'nullable|array',
            'thumbnail.*' => 'nullable|file',
        ]);

        $whychoose = WhyChooseUs::findOrFail($id);

        $topdata = [
            'top_heading' => $request->top_heading,
            'top_des' => $request->top_des,
        ];

        $oldMultipleData = $whychoose->multiple_data ?? [];

        $multipledata = [];

        $titles = $request->title ?? [];
        $icons = $request->icons ?? [];
        $descriptions = $request->description ?? [];

        foreach ($titles as $key => $title) {

            $pdfImageName = $oldMultipleData[$key]['pdf_image'] ?? null;
            $thumbnailName = $oldMultipleData[$key]['thumbnail'] ?? null;

            if ($request->hasFile("pdf_image.$key")) {

                // Delete old file
                if (
                    $pdfImageName &&
                    file_exists(
                        public_path('uploads/whychoose/pdf/'.$pdfImageName)
                    )
                ) {
                    unlink(
                        public_path('uploads/whychoose/pdf/'.$pdfImageName)
                    );
                }

                $pdfImage = $request->file("pdf_image.$key");

                $pdfImageName = time().'_'.$key.'_'.
                    $pdfImage->getClientOriginalName();

                $pdfImage->move(
                    public_path('uploads/whychoose/pdf'),
                    $pdfImageName
                );
            }

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
                'pdf_image' => $pdfImageName,
                'thumbnail' => $thumbnailName,
            ];
        }

        $whychoose->update([
            'top_content' => $topdata,
            'multiple_data' => $multipledata,
        ]);

        return redirect()
            ->route('admin.hero.whychoose')
            ->with('success', 'Data updated successfully');
    }

    public function destroywhychoose($id)
    {
        $whychoose = WhyChooseUs::findOrFail($id);

        $multipleData = $whychoose->multiple_data ?? [];

        foreach ($multipleData as $data) {

            // Delete PDF / Image
            if (
                ! empty($data['pdf_image']) &&
                file_exists(
                    public_path('uploads/whychoose/pdf/'.$data['pdf_image'])
                )
            ) {
                unlink(
                    public_path('uploads/whychoose/pdf/'.$data['pdf_image'])
                );
            }

            // Delete Thumbnail
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
