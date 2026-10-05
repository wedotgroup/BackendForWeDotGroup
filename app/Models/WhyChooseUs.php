<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhyChooseUs extends Model
{
    protected $table = "why_choose_us";
    protected $primaryKey = 'id';
    protected $fillable = ['icons','title','description','pdf_file','thumbnail','link_text'];

    

}
