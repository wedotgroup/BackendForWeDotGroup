<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AboutUS;
use App\Models\HeroSection;
use App\Models\ManageConsultancy;
use App\Models\PartnerLogo;
use App\Models\WhyChooseUs;

class ManagefrontControoler extends Controller
{
    public function herosection()
    {
        try {
            $data = HeroSection::all();
            $items = [];
            foreach ($data as $item) {
                $items['badges'] = json_decode($item->badges);
                $items['hero_title'] = $item->hero_title;
                $items['hero_heading'] = $item->hero_heading;
                $items['description'] = $item->description;
                $items['video'] = $item->video_file;
                $items['button_one'] = $item->button_one;
                $items['button_two'] = $item->button_two;
                $items['list_items'] = json_decode($item->list_items);
                $items['extra_lists'] = json_decode($item->extra_lists);
            }

            return response()->json([
                'message' => 'Hero section data here',
                'status' => true,
                'data' => $items,

            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something wend wrong',
                'status' => false,
                'error' => $e->getMessage(),
                'data' => [],
            ], 500);
        }
    }

    public function whychoose()
    {
        try {
            $data = WhyChooseUs::select('title', 'description', 'pdf_file', 'thumbnail', 'id', 'icons', 'link_text')->get();
            if (! $data) {
                return response()->json([
                    'message' => 'Data not found',
                    'status' => false,
                    'data' => [],
                ], 400);
            }

            return response()->json([
                'message' => 'Why Choose Us data here',
                'status' => true,
                'data' => $data,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something wend wrong',
                'status' => false,
                'data' => [],
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    public function manageCansultancy()
    {
        try {
            $data = ManageConsultancy::select('title', 'description', 'thumbnail', 'id', 'icons', 'company_name')->get();
            if (! $data) {
                return response()->json([
                    'message' => 'Data not found',
                    'status' => false,
                    'data' => [],
                ], 400);
            }

            return response()->json([
                'message' => 'Manage Consultancy data here',
                'status' => true,
                'data' => $data,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something wend wrong',
                'status' => false,
                'data' => [],
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    public function OurPartnerLogo()
    {
        try {
            $data = PartnerLogo::select('logos')->first();
            $data->logos = json_decode($data->logos);
            if (! $data) {
                return response()->json([
                    'message' => 'Data not found',
                    'status' => false,
                    'data' => [],
                ], 400);
            }

            return response()->json([
                'message' => 'Our Partener Logos data here',
                'status' => true,
                'data' => $data,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something wend wrong',
                'status' => false,
                'data' => [],
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    public function aboutUsAPI()
    {
        try {
            $data = AboutUS::select("hero_section", 'about_company', 'mission', 'vision', 'ceo_message')->first();
            $data->hero_section = json_decode($data->hero_section);
            $data->about_company = json_decode($data->about_company);
            $data->mission = json_decode($data->mission);
            $data->vision = json_decode($data->vision);
            $data->ceo_message = json_decode($data->ceo_message);

            if (!$data) {
                return response()->json([
                    "message" => "About Us content not found",
                    "status" => false,
                    "data" => null
                ], 400);
            }

            return response()->json([
                "message" => "Content featched successful",
                "status" => true,
                "data" => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Something went wrong",
                "status" => false,
                "error" => $e->getMessage(),
                "data" => [],
            ], 500);
        }
    }
}
