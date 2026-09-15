<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUS extends Model
{

    protected $primaryKey = 'id';
    protected $fillable = ["hero_section","about_company","mission_vision","ceo_message"];
    protected $table ="about_u_s";
}
