<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManageItcnslt extends Model
{
    protected $primaryKey = 'id';
    protected $table = "manage_itcnslts";
    protected $fillable = ['first_heading','small_paragraph','button1_text','button2_text','hero_image','heading','description','services','button3_text','our_services'];

    protected $casts = ['services'=>"array",'our_services','array'];
}
