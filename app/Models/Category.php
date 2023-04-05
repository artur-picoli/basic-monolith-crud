<?php

namespace App\Models;

use App\Models\News;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public static function scopeFilter($query, $request)
    {
        return $query
            ->when($request->filter, function ($query, $request) {
                return $query->where('name', 'like', "%{$request}%");
            })->latest();
    }

    public function news(): BelongsToMany
    {
        return $this->belongsToMany(News::class,'news_category', 'category_id' , 'news_id' );
    }
}
