<?php

namespace App\Http\Controllers;

use App\Actions\News\NewsIndexAction;
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
        return NewsIndexAction::get($request, 'home.home');
    }

    public function show(string $id)
    {
        return view('home.show', [
            'news' => News::with('categories')->find($id)
        ]);
    }
}
