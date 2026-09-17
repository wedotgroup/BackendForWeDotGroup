<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManageCupon extends Model
{
    protected $table = "manage_cupons";
    protected $primaryKey = 'id';
    protected $fillable = ['user_id','product_id','use_cupon_count','expire_date'];

    public function uses (){
        return $this->belongsTo(User::class,'user_id');
    }

    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
