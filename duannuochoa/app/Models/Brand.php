<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $table = 'brands';
    protected $primaryKey = 'brand_id';
    public $timestamps = false; // migration has no timestamps

    protected $fillable = [
        'name',
        'logo_url',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'brand_id', 'brand_id');
    }
}
