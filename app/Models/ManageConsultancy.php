<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManageConsultancy extends Model
{
    protected $primaryKey = 'id';
    protected $table = "manage_consultancies";
    protected $fillable = ['icons','title','description','company_name','thumbnail'];
}
