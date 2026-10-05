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

        return view('frontend.homesection.whychooseus.index', compact('whyChooses'));
    }

    public function createwhychoose()
    {
        return view('frontend.homesection.whychooseus.create');
    }

    public function editwhychoose($id)
    {
        $whychoose = WhyChooseUs::findOrfail($id);

        return view('frontend.homesection.whychooseus.edit', compact('whychoose'));
    }

    public function storewhychoose(Request $request)
    {
        $request->validate([
            'icons' => 'required|string',
            'link_text' => 'required|string',
            'title' => 'required|string',
            'description' => 'required|string',
            'pdf_file' => 'required|file',
            'thumbnail' => 'required|file',
        ]);

        $pdfFile = '';
        $thumbnailfile = '';

        if ($request->hasFile('pdf_file')) {
            $file = $request->file('pdf_file');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $pdfFile = 'uploads/whychoose/'.$filename;
            $file->move(public_path('uploads/whychoose'), $filename);
        }

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $thumbnail = time().'.'.$file->getClientOriginalExtension();
            $thumbnailfile = 'uploads/thumbnail/'.$thumbnail;
            $file->move(public_path('uploads/thumbnail'), $thumbnail);
        }

        $data = [
            'icons' => $request->icons,
            'title' => $request->title,
            'link_text' => $request->link_text,
            'description' => $request->description,
            'thumbnail' => $thumbnailfile,
            'pdf_file' => $pdfFile,
        ];

        AddData(WhyChooseUs::class, $data);

        return redirect()->route('admin.hero.whychoose')->with('success', 'Data Created SuccessFul');
    }

    public function updatewhychoose(Request $request, $id)
    {
        $whychoose = WhyChooseUs::findOrFail($id);

        $request->validate([
            'icons' => 'required|string',
            'link_text' => 'required|string',
            'title' => 'required|string',
            'description' => 'required|string',
            'pdf_file' => 'nullable|file',
            'thumbnail' => 'nullable|file',
        ]);

        $pdfFile = $whychoose->pdf_file;
        $thumbnailfile = $whychoose->thumbnail;

        if ($request->hasFile('pdf_file')) {

            if (! empty($whychoose->pdf_file)) {
                $oldpdf = public_path($whychoose->pdf_file);

                if (file_exists($oldpdf)) {
                    unlink($oldpdf);
                }
            }

            $file = $request->file('pdf_file');

            $filename = time().'_pdf.'.$file->getClientOriginalExtension();

            $file->move(
                public_path('uploads/whychoose'),
                $filename
            );

            $pdfFile = 'uploads/whychoose/'.$filename;
        }

        if ($request->hasFile('thumbnail')) {

            if (! empty($whychoose->thumbnail)) {
                $oldthumbnail = public_path($whychoose->thumbnail);

                if (file_exists($oldthumbnail)) {
                    unlink($oldthumbnail);
                }
            }

            $file = $request->file('thumbnail');

            $filename = time().'_thumbnail.'.$file->getClientOriginalExtension();

            $file->move(
                public_path('uploads/thumbnail'),
                $filename
            );

            $thumbnailfile = 'uploads/thumbnail/'.$filename;
        }

        $data = [
            'icons' => $request->icons,
            'title' => $request->title,
            'link_text' => $request->link_text,
            'description' => $request->description,
            'thumbnail' => $thumbnailfile,
            'pdf_file' => $pdfFile,
        ];

        UpdateData(WhyChooseUs::class, $data, ['id' => $id]);

        return redirect()
            ->route('admin.hero.whychoose')
            ->with('success', 'Data Updated Successfully');
    }

    public function destroywhychoose($id)
    {
        $whychoose = WhyChooseUs::findOrFail($id);
        if (! empty($whychoose->thumbnail)) {
            $oldthumbnail = public_path($whychoose->thumbnail);

            if (file_exists($oldthumbnail)) {
                unlink($oldthumbnail);
            }
        }

        if (! empty($whychoose->pdf_file)) {
            $oldpdf = public_path($whychoose->pdf_file);

            if (file_exists($oldpdf)) {
                unlink($oldpdf);
            }
        }

        $whychoose->delete();

        return redirect()
            ->route('admin.hero.whychoose')
            ->with('success', 'Data deleted successfully');
    }
}
