<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model
{
    use HasFactory;

    protected $table = 'shipping_methods';
    protected $primaryKey = 'shipping_id';
    // migration has timestamps
    public $timestamps = true;

    protected $fillable = [
        'name',
        'fee',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'shipping_id', 'shipping_id');
    }
}
