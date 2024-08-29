<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "description",
        "image",
        "category_id",
        "price",
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function variants() {
        return $this->hasMany(ProductVariant::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function getTotalSoldQuantityAttribute()
    {
        return $this->variants->sum('sold_quantity');
    }

    public function getTotalStockQuantityAttribute()
    {
        return $this->variants->sum('stock_quantity');
    }

    public function getFirstVariantPriceAttribute()
    {
        return $this->variants->first()->price ?? 0;
    }
}
