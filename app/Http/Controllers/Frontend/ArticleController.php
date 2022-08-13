<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\StoreArticleRequest;
use App\Models\Article;
use App\Models\ArticleAlbum;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
        return view('frontend.articles.show', compact('article', 'latestArticles', 'relatedArticles'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('frontend.articles.create', compact('categories'));
    }

    public function store(StoreArticleRequest $request)
    {
        $images = $request->file('images');
        $allowedfileExtension = ['png', 'jpg', 'jpeg'];
        $fileInMB = 1.5;
        $allowedfileSize = (1024 * $fileInMB) * 1024; // KB
        $imagesErrors = [];

        foreach ($images as $image) {
            if (!in_array($image->getClientOriginalExtension(), $allowedfileExtension)) {
                if (App::getLocale() == 'ar') {
                    $imagesErrors[] = $image->getClientOriginalName() . ' ليس صورة يجب ان يكون من نوع , ( ' . implode(", ", $allowedfileExtension) . ' )';
                } else {
                    $imagesErrors[] = $image->getClientOriginalName() . ' not in allowed extensions, ( ' . implode(", ", $allowedfileExtension) . ' )';
                }
            } else if ($image->getSize() > $allowedfileSize) {
                if (App::getLocale() == 'ar') {
                    $imagesErrors[] = $image->getClientOriginalName() . ' حجم الصورة كبير جدا , اكبر حجم ممكن هو  ( ' . $fileInMB . 'MB )';
                } else {
                    $imagesErrors[] = $image->getClientOriginalName() . ' image size too big , max image size is ( ' . $fileInMB . 'MB )';
                }
            }
        }

        if (count($imagesErrors) == 0) {
            $articleData = $request->all();
            $articleData['user_id'] = Auth::id();
            $article = Article::create($articleData);
            $article->categories()->attach($request->categories);

            foreach ($images as $image) {
                $imagePath = $image->store('images', 'public');
                ArticleAlbum::create([
                    'path' => $imagePath,
                    'article_id' => $article->id
                ]);
            }
        }

        return redirect()->route('articles.create')->with('imagesErrors', $imagesErrors);
    }
}
