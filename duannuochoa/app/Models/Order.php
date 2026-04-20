<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $primaryKey = 'order_id';

    protected $fillable = [
        'user_id',
        'shipping_id',
        'discount_id',
        'total_amount',
        'status',
        'cancel_reason',
        'return_reason',
        'return_image',
        'is_refunded',
        'client_notified',
        'full_name',
        'phone',
        'address',
        'note',
        'payment_method',
        'payment_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function shippingMethod()
    {
        return $this->belongsTo(ShippingMethod::class, 'shipping_id', 'shipping_id');
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class, 'discount_id', 'discount_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'order_id');
    }
}
