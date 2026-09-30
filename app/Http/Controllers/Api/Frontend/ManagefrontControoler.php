<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;

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
                "error"=>$e->getMessage(),
                'data' => [],
            ], 500);
        }

    }
}
