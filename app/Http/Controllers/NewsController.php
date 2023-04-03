<?php

namespace App\Http\Controllers;

use App\Actions\News\NewsIndexAction;
use App\Actions\News\NewsStoreAction;
use App\Actions\News\NewsUpdateAction;
use App\Http\Requests\NewsRequest;
use App\Models\Category;
use App\Models\News;
use DragonCode\Support\Facades\Filesystem\File;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return NewsIndexAction::get($request);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('news.create',[
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NewsRequest $request)
    {
        NewsStoreAction::save($request);

        return redirect(route('news.index'))->with('saved', true);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        return view('news.edit', [
            'news' => $news,
            'categories' => Category::all(),
            'news_categories' => $news->categories->pluck('id')->toArray()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NewsRequest $request, News $news)
    {
        NewsUpdateAction::update($request, $news);

        return redirect(route('news.index'))->with('updated', true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        $news->categories()->detach();

        File::delete($news->image_path);

        $news->delete();

        return redirect(route('news.index'))->with('deleted', true);

    }
}
