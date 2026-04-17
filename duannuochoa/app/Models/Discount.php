<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $table = 'discounts';
    protected $primaryKey = 'discount_id';
    public $timestamps = false; // migration has no timestamps

    protected $fillable = [
        'code',
        'discount_value',
        'discount_type',
        'min_order_value',
        'valid_from',
        'valid_to',
        'usage_limit',
        'points_required',
    ];

    protected $casts = [
        'valid_from' => 'datetime',
        'valid_to' => 'datetime',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'discount_id', 'discount_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_discounts', 'discount_id', 'user_id')
                    ->withPivot('used_at', 'created_at');
    }
}
