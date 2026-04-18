<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $table = 'articles';
    protected $primaryKey = 'article_id';

    protected $fillable = [
        'author_id',
        'title',
        'slug',
        'image',
        'content',
        'summary',
        'status',
        'created_at',
        'updated_at',
    ];

    /**
     * Get the author that owns the article.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'user_id');
    }

    /**
     * Scope for published articles.
     */
    public function scopePublished($query)
    {
        return $query->where('status', true);
    }
}
