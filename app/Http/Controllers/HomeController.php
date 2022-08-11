<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categoryQuery = request()->query('category') ? request()->query('category') : 'all';
        $searchQuery = request()->query('s') ? request()->query('s') : '';

        $categories = Category::translatedIn(App::getLocale())->get();

        $articles = Article::whereHas('translations', function ($q) use ($searchQuery) {
            if ($searchQuery) {
                $q->where('title', 'like', '%' . $searchQuery . '%');
            }
        })->whereHas('categories', function ($q2) {
            $q2->whereHas('translations', function ($q3) {
                if (request()->query('category')) {
                    $q3->where('title', request()->query('category'));
                }
            });
        })->translatedIn(App::getLocale())->latest()->paginate(4);
        $latestArticles = Article::translatedIn(App::getLocale())->latest()->limit(4)->get();

        return view('index', compact('categories', 'articles', 'latestArticles', 'categoryQuery', 'searchQuery'));
    }
}
