<?php

declare(strict_types=1);

namespace App\Actions\News;

use App\Models\Category;
use App\Models\News;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class NewsIndexAction
{
    public static function get(Request $request, string $view = 'news.index'): View
    {
        $request->validate([
            'filter' => 'max:255',
            'categories' => 'array'
        ]);

        return view($view, [
            'news' => News::filter($request)->paginate(5),
            'filter' => $request->filter,
            'filterCategories' => $request->categories ?? [],
            'categories' => Category::all()
        ]);

    }
}
