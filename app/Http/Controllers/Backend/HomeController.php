<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $heros = HeroSection::all();
        return view('frontend.homesection.hero.index',compact('heros'));
    }

    public function create()
    {
        return view('frontend.homesection.hero.create');
    }

    public function edit($id)
    {
        $hero = HeroSection::find($id);
        return view('frontend.homesection.hero.edit',compact('hero'));
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
            $herolist['title'] = $title;
            $herolist['value'] = $request->list_items_value[$key];
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

    public function update(Request $request, $id) {}

    public function destroy($id) {}

    public function indexwhychoose()
    {
        return view('frontend.homesection.whychooseus.index');
    }

    public function createwhychoose()
    {
        return view('frontend.homesection.whychooseus.create');
    }

    public function editwhychoose($id)
    {
        return view('frontend.homesection.whychooseus.edit');
    }

    public function storewhychoose(Request $request) {}

    public function updatewhychoose(Request $request, $id) {}

    public function destroywhychoose($id) {}
}
