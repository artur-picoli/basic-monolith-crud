<?php

declare(strict_types=1);

namespace App\Actions\News;

use App\Models\News;
use DragonCode\Support\Facades\Filesystem\File;
use Illuminate\Http\Request;

class NewsUpdateAction
{
    public static function update(Request $request, News $news): void
    {
        $validated = $request->validated();

        $arrUpdate = [
            'title' => $validated['title'],
            'body' => $validated['body'],
        ];

        $arrFile = [];

        if ($request->hasFile('file')) {
            $fileName = time() . $validated['file']->getClientOriginalName();
            $request->file->storeAs('public/news', $fileName);
            File::delete($news->image_path);
            $arrFile = [
                'image_name' => $fileName,
                'image_path' =>  'storage/news/' . $fileName
            ];
            $arrUpdate = array_merge($arrFile, $arrUpdate);
        };

        $news->update($arrUpdate);

        $news->categories()->sync($validated['categories']);

    }
}
