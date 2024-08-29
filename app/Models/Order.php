<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_date',
        'status',
        'total_amount',
        'name',
        'address',
        'payment_method',
        'phone_number',
        'order_code'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(OrderDetail::class);
    }

    protected $casts = [
        'status' => OrderStatus::class,
        'order_date' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            do {
                $order_code = 'ORD-' . strtoupper(Str::random(6));
            } while (Order::where('order_code', $order_code)->exists());

            $order->order_code = $order_code;
        });
    }
}
