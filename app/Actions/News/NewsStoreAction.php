<?php

declare(strict_types=1);

namespace App\Actions\News;

use App\Models\News;
use Illuminate\Http\Request;

class NewsStoreAction
{
    public static function save(Request $request): void
    {
        $validated = $request->validated();

        $fileName = time() . $validated['file']->getClientOriginalName();

        $request->file->storeAs('public/news', $fileName);

        $news = News::create([
            'title' => $validated['title'],
            'body' => $validated['body'],
            'image_path' => 'storage/news/' . $fileName,
            'image_name' => $fileName
        ]);

        $news->categories()->attach($validated['categories']);

    }
}
