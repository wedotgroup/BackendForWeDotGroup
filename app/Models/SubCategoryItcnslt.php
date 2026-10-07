<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategoryItcnslt extends Model
{
    protected $primaryKey = 'id';
    protected $table = "sub_category_itcnslts";
    protected $fillable = ['category_id','name','slug'];

    public function category(){
        return $this->belongsTo(CategoryItcnslt::class,"category_id");
    }
}
