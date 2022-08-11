<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function show($id)
    {
        $article = Article::find($id);
        $cat_ids = [];
        foreach ($article->categories as $category) {
            $cat_ids[] = $category->id;
        }

        $relatedArticles = Article::whereHas('categories', function ($q) use ($cat_ids, $article) {
            $q->whereIn('category_id', $cat_ids)->where('article_id', '<>', 5)->where('article_id', '<>', $article->id);
        })->limit(3)->latest()->get();

        $latestArticles = Article::translatedIn(App::getLocale())->latest()->limit(4)->get();
        return view('articles.show', compact('article', 'latestArticles', 'relatedArticles'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('articles.create', compact('categories'));
    }

    public function store(StoreArticleRequest $request)
    {
        $imagePath = $request->file('image')->store('images', 'public');
        $articleData = $request->all();
        $articleData['user_id'] = Auth::id();
        $articleData['image'] = $imagePath;
        $article = Article::create($articleData);
        $article->categories()->attach($request->categories);

        return redirect()->route('articles.create');
    }
}
