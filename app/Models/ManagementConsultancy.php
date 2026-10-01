<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManagementConsultancy extends Model
{
    protected $table ="management_consultancies";
    protected $primaryKey = 'id';

    protected $fillable = ['multiple_data'];

    protected $casts = ['multiple'=>'array'];
}
