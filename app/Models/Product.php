<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected  $fillable = ['image','name','highlights','cupon_code','description','price'];

    protected $casts = ['hightlights'=>'array'];
}
