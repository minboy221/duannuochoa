<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDiscount extends Model
{
    use HasFactory;

    protected $table = 'user_discounts';
    protected $primaryKey = 'user_discount_id';
    public $timestamps = false; // logic handles created_at manually or via useCurrent

    protected $fillable = [
        'user_id',
        'discount_id',
        'used_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class, 'discount_id', 'discount_id');
    }
}
