<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $table = 'product_variants';
    protected $primaryKey = 'variant_id';
    public $timestamps = false; // migration has no timestamps

    protected $fillable = [
        'product_id',
        'volume_id', // it's integer in DB
        'color',
        'price',
        'stock_quantity',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'variant_id', 'variant_id');
    }
}
