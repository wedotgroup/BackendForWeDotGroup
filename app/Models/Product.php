<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $primaryKey = 'id';

    protected $fillable = [
        'top_highlights',
        'title',
        'slug',
        'rating',
        'rating_text',
        'currency_code',
        'price',
        'stock_price',
        'description',
        'package_includes',
        'images',
        'category',
        'cupon_code',
        'cupon_price',
    ];

    protected $casts = ['package_includes' => 'array'];

    public function Managecupon()
    {
        return $this->hasMany(ManageCupon::class, 'product_id');
    }

    public function cart()
    {
        return $this->hasMany(Cart::class, 'product_id');
    }

    public function orderItem(){
        return $this->hasMany(OrderItem::class,'product_id');
    }
}
