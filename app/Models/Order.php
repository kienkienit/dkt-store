<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'phone_number'
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
}
