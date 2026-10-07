<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AboutUS;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index()
    {
        $aboutUs = AboutUS::all();
        return view('frontend.aboutsus.index', compact("aboutUs"));
    }

    public function create()
    {
        return view('frontend.aboutsus.create');
    }

    public function edit($id)
    {
        $aboutUs = AboutUS::findOrFail($id);

        return view('frontend.aboutsus.edit', compact("aboutUs"));
    }

    public function store(Request $request)
    {
        $request->validate([
            'slugtext'         => 'required|string',
            'heading'          => 'required|string',
            'smallText'        => 'required|string',
            'button1'          => 'required|string',
            'button2'          => 'required|string',

            'aboutTitle'       => 'required|string',
            "aboutImage"       => "required|file",
            'aboutHeading'     => 'required|string',
            'aboutParagraph'   => 'required|string',
            'aboutButton'      => 'required|string',

            'missionIcon'      => 'required|string',
            'missionHeading'   => 'required|string',
            'missionParagraph' => 'required|string',

            'visionIcon'       => 'required|string',
            'visionHeading'    => 'required|string',
            'visionParagraph'  => 'required|string',

            'founderTitle'     => 'required|string',
            'founderHeading'   => 'required|string',
            'founderImage' => "required|file",
            'founderName'      => 'required|string',
            'founderShortDesc' => 'required|string',
            'founderParagraph' => 'required|string',
            'founderNote'      => 'required|string',
            'statTitle1'       => 'required|string',
            'statValue1'       => 'required|string',
            'statTitle2'       => 'required|string',
            'statValue2'       => 'required|string',
            'statTitle3'       => 'required|string',
            'statValue3'       => 'required|string',
        ]);

        $aboutImage = null;
        $founderImage = null;

        if ($request->hasFile('aboutImage')) {
            $file = $request->file("aboutImage");
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path("uploads/about/aboutimg"), $filename);
            $aboutImage = "uploads/about/aboutimg/" . $filename;
        }

        if ($request->hasFile('founderImage')) {
            $file = $request->file("founderImage");
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path("uploads/about/founderImage"), $filename);
            $founderImage = "uploads/about/founderImage/" . $filename;
        }
        $header_section = [
            "slugtext" => $request->slugtext,
            "heading" => $request->heading,
            "smallText" => $request->smallText,
            "button1" => $request->button1,
            'button2' => $request->button2,
        ];

        $aboutsection = [
            'aboutTitle'       => $request->aboutTitle,
            "aboutImage"       => $aboutImage,
            'aboutHeading'     => $request->aboutHeading,
            'aboutParagraph'   => $request->aboutParagraph,
            'aboutButton' => $request->aboutButton
        ];

        $missionsection = [
            'missionIcon'      => $request->missionIcon,
            'missionHeading'   => $request->missionHeading,
            'missionParagraph' => $request->missionParagraph
        ];

        $visonsection = [
            'visionIcon'       => $request->visionIcon,
            'visionHeading'    => $request->visionHeading,
            'visionParagraph'  => $request->visionParagraph,

        ];

        $foundersection = [
            'founderTitle'     => $request->founderTitle,
            'founderHeading'   => $request->founderHeading,
            'founderImage' => $founderImage,
            'founderName'      => $request->founderName,
            'founderShortDesc' => $request->founderShortDesc,
            'founderParagraph' => $request->founderParagraph,
            'founderNote'      => $request->founderNote,
            'statTitle1'       => $request->statTitle1,
            'statValue1'       => $request->statValue1,
            'statTitle2'       => $request->statTitle2,
            'statValue2'       => $request->statValue2,
            'statTitle3'       => $request->statTitle3,
            'statValue3'       => $request->statValue3,
        ];

        $createdata = AboutUS::create([
            "hero_section" => json_encode($header_section),
            "about_company" => json_encode($aboutsection),
            "mission" => json_encode($missionsection),
            'vision' => json_encode($visonsection),
            "ceo_message" => json_encode($foundersection)
        ]);

        if ($createdata) {
            return redirect()->route('admin.abouts')->with("success", 'Data created Successful');
        }

        return back('admin.abouts')->with("error", 'Data creation failed');
    }


    public function update(Request $request, $id)
    {
        $aboutUs = AboutUS::findOrFail($id);

        $request->validate([
            'slugtext'         => 'nullable|string',
            'heading'          => 'nullable|string',
            'smallText'        => 'nullable|string',
            'button1'          => 'nullable|string',
            'button2'          => 'nullable|string',

            'aboutTitle'       => 'nullable|string',
            "aboutImage"       => "nullable|file",
            'aboutHeading'     => 'nullable|string',
            'aboutParagraph'   => 'nullable|string',
            'aboutButton'      => 'nullable|string',

            'missionIcon'      => 'nullable|string',
            'missionHeading'   => 'nullable|string',
            'missionParagraph' => 'nullable|string',

            'visionIcon'       => 'nullable|string',
            'visionHeading'    => 'nullable|string',
            'visionParagraph'  => 'nullable|string',

            'founderTitle'     => 'nullable|string',
            'founderHeading'   => 'nullable|string',
            'founderImage'     => "nullable|file",
            'founderName'      => 'nullable|string',
            'founderShortDesc' => 'nullable|string',
            'founderParagraph' => 'nullable|string',
            'founderNote'      => 'nullable|string',
            'statTitle1'       => 'nullable|string',
            'statValue1'       => 'nullable|string',
            'statTitle2'       => 'nullable|string',
            'statValue2'       => 'nullable|string',
            'statTitle3'       => 'nullable|string',
            'statValue3'       => 'nullable|string',
        ]);
        $oldAboutImage = json_decode($aboutUs->about_company, true);
        $oldFounderImage = json_decode($aboutUs->ceo_message, true);
        $aboutImage = $oldAboutImage['aboutImage'];
        $founderImage = $oldFounderImage['founderImage'];

        if ($request->hasFile('aboutImage')) {

            if (!empty($aboutImage) && file_exists($aboutImage)) {
                unlink(public_path($aboutImage));
            }
            $file = $request->file("aboutImage");
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path("uploads/about/aboutimg"), $filename);
            $aboutImage = "uploads/about/aboutimg/" . $filename;
        }

        if ($request->hasFile('founderImage')) {
            if (!empty($founderImage) && file_exists($founderImage)) {
                unlink(public_path($founderImage));
            }
            $file = $request->file("founderImage");
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path("uploads/about/founderImage"), $filename);
            $founderImage = "uploads/about/founderImage/" . $filename;
        }

        $header_section = [
            "slugtext" => $request->slugtext,
            "heading" => $request->heading,
            "smalltext" => $request->smalltext,
            "button1" => $request->button1,
            'button2' => $request->button2,
        ];

        $aboutsection = [
            'aboutTitle'       => $request->aboutTitle,
            "aboutImage"       => $aboutImage,
            'aboutHeading'     => $request->aboutHeading,
            'aboutParagraph'   => $request->aboutParagraph,
            'aboutButton' => $request->aboutButton
        ];

        $missionsection = [
            'missionIcon'      => $request->missionIcon,
            'missionHeading'   => $request->missionHeading,
            'missionParagraph' => $request->missionParagraph
        ];

        $visonsection = [
            'visionIcon'       => $request->visionIcon,
            'visionHeading'    => $request->visionHeading,
            'visionParagraph'  => $request->visionParagraph,

        ];

        $foundersection = [
            'founderTitle'     => $request->founderTitle,
            'founderHeading'   => $request->founderHeading,
            'founderImage' => $founderImage,
            'founderName'      => $request->founderName,
            'founderShortDesc' => $request->founderShortDesc,
            'founderParagraph' => $request->founderParagraph,
            'founderNote'      => $request->founderNote,
            'statTitle1'       => $request->statTitle1,
            'statValue1'       => $request->statValue1,
            'statTitle2'       => $request->statTitle2,
            'statValue2'       => $request->statValue2,
            'statTitle3'       => $request->statTitle3,
            'statValue3'       => $request->statValue3,
        ];

        $createdata = $aboutUs->update([
            "hero_section" => json_encode($header_section),
            "about_company" => json_encode($aboutsection),
            "mission" => json_encode($missionsection),
            'vision' => json_encode($visonsection),
            "ceo_message" => json_encode($foundersection)
        ]);

        if ($createdata) {
            return redirect()->route('admin.abouts')->with("success", 'Data created Successful');
        }

        return back('admin.abouts')->with("error", 'Data creation failed');
    }

    public function destroy($id)
    {
        $about = AboutUS::findOrFail($id);
        $oldaboutimage = json_decode($about->about_company, true) ?? [];
        $oldfounderImage = json_decode($about->ceo_message, true) ?? [];

        if (!empty($oldaboutimage['aboutImage']) && file_exists($oldaboutimage['aboutImage'])) {
            unlink(public_path($oldaboutimage['aboutImage']));
        }

        if (!empty($oldfounderImage['founderImage']) && file_exists($oldfounderImage['founderImage'])) {
            unlink(public_path($oldfounderImage['founderImage']));
        }

        $about->delete();
        return redirect()->route('admin.abouts')->with("success", 'Data delete successful');
    }
}
