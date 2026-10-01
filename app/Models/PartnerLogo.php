<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnerLogo extends Model
{
    protected $primaryKey = 'id';
    protected $table = "partner_logos";
    protected $fillable = ['logos'];

    protected $casts = ["logos"=>'array'];
}
