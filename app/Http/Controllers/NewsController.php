<?php

namespace App\Http\Controllers;

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

        $request->validate([
            'filter' => 'max:255',
            'categories' => 'array'
        ]);

        return view('news.index', [
            'news' => News::filter($request)->paginate(5),
            'filter' => $request->filter,
            'filterCategories' => $request->categories ?? [],
            'categories' => Category::all()
        ]);
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

        return redirect(route('news.index'))->with('saved', true);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
