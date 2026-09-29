<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomePage extends Model
{
    protected $table ="home_pages";
    protected $fillable = ["hero_section","why_choose_us"];
    protected $primaryKey = 'id';

    protected $casts = ['hero_section'=>'array','why_choose_us'=>"array"];
}
