<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryItcnslt extends Model
{
    protected $tbale = "category_itcnslts";
    protected $primaryKey = 'id';
    protected $fillable = ["name", "slug"];

    public function subcategory()
    {
        return $this->hasMany(SubCategoryItcnslt::class, 'category_id');
    }
}
