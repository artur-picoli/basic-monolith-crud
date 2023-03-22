<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->validate([
            'filter' => 'max:255'
        ]);

        return view('category.index', [
            'categories' => Category::getDataIndex($request)->paginate(5),
            'filter' => $request->filter,
        ]);
    }

    public function create()
    {
        return view('category.create',[
            'category' => new Category()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $validated = $request->validated();

        Category::create($validated);

        session()->flash('saved', 'success');

        return response()->json(['route' => route('category.index')]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('category.edit',[
            'category' => $category
        ]);


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $validated = $request->validated();

        $category->update($validated);

        session()->flash('saved', 'success');

        return response()->json(['route' => route('category.index')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect(route('category.index'))->with('deleted', true);
    }
}