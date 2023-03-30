<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;


class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        $request->validate([
            'filter' => 'max:255',
            'categories' => 'array'
        ]);


        return view('home.home', [
            'news' => News::filter($request)->paginate(5),
            'filter' => $request->filter,
            'filterCategories' => $request->categories ?? [],
            'categories' => Category::all()
        ]);
    }

    public function show(string $id)
    {
        return view('home.show', [
            'news' => News::with('categories')->find($id)
        ]);
    }
}
