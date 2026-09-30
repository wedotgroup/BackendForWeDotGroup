<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhyChooseUs extends Model
{
    protected $primaryKey = 'id';
    protected $table = "why_choose_us";
    protected $fillable = ["top_content",'multiple_data'];

    protected $casts = ['top_content'=>'array','multiple_data'=>'array'];
}
