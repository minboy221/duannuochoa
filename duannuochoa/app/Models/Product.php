<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'product_id';
    public $timestamps = false; // migration has created_at only, but we'll disable default eloquent timestamps

    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'description',
        'base_price',
        'img',
        'is_featured',
        'is_bestseller',
        'created_at',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'brand_id');
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class, 'product_id', 'product_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id', 'product_id');
    }

    public function averageRating()
    {
        return $this->reviews()->avg('rating') ?: 0;
    }
}
