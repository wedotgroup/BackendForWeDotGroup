<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSection extends Model
{
    protected $primaryKey = 'id';
    protected $table ="hero_sections";
    protected $fillable = ['badges','hero_title','hero_heading','description','button_one','link_one','button_two','link_two','extra_lists','list_items','video_file'];

    protected $casts = ["badges"=>"array",'extra_lists'=>'array','list_items'=>"array"];
}
