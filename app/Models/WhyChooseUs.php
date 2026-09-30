<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhyChooseUs extends Model
{
    protected $primaryKey = 'id';
    protected $table = "why_choose_us";
    protected $fillable = ['heading','description','image','pdf_file','short_text','title','link_text','icons'];
}
