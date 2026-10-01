<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'order_reference',
        'user_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'country',
        'zip',
        'subtotal',
        'discount',
        'shipping',
        'total',
        'payment_method',
        'payment_status',
        'payment_error',
        'order_status',
        'tabby_payment_id',
        'tabby_session_id',
        'tabby_status',
        'paid_at',
    ];

    protected $casts = [

        'subtotal' => 'decimal:2',
        'discount' => 'decimal:2',
        'shipping' => 'decimal:2',
        'total' => 'decimal:2',
        'paid_at' => 'datetime',
    ];


    public function user()
    {
        return $this->belongsTo(
            User::class,
            'user_id'
        );
    }


    public function items(): HasMany
    {
        return $this->hasMany(
            OrderItem::class,
            'order_id'
        );
    }

    public function isPending(): bool
    {
        return $this->payment_status === 'pending';
    }


    public function isPaid(): bool
    {
        return $this->payment_status === 'paid';
    }


    public function isFailed(): bool
    {
        return $this->payment_status === 'failed';
    }


    public function isCancelled(): bool
    {
        return $this->payment_status === 'cancelled';
    }


    public function isRefunded(): bool
    {
        return $this->payment_status === 'refunded';
    }
}