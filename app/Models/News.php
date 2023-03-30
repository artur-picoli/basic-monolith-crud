<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'image_name',
        'image_path'
    ];

    public function scopeFilter($query, $request)
    {
        return $query
            ->when($request->filter, function ($query, $request) {
                return $query->where('title', 'like', "%{$request}%");
            })
            ->when($request->categories, function ($query, $request) {
                return $query->whereHas('categories', function ($query) use ($request) {
                    $query->whereIn('categories.id', $request);
                });
            })
            ->latest();
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'news_category', 'news_id', 'category_id');
    }
}
