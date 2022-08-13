<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::translatedIn(App::getLocale())->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $rules = [];
        foreach (config('translatable.locales') as $locale) {
            $rules[$locale . '.title'] = ['required', 'max:255', 'unique:category_translations,title'];
        }
        $request->validate($rules);

        Category::create($request->all());
        return redirect()->route('dashboard.categories.create');
    }

    public function edit($category_id)
    {
        $cat = Category::findOrfail($category_id);
        $category = [];

        foreach (config('translatable.locales') as $i => $locale) {
            $category[$cat->translations[$i]->locale] = [
                'title' => $cat->translations[$i]->title,
                'description' => $cat->translations[$i]->description,
            ];
        }

        return view('admin.categories.edit', compact('category', 'category_id'));
    }

    public function update(Request $request, $category_id)
    {
        $category = Category::find($category_id);
        $langsIDs = [];
        foreach ($category->translations as $cat) {
            $langsIDs[] = $cat->id;
        }

        $rules = [];
        foreach (config('translatable.locales') as $locale) {
            $rules[$locale . '.title'] =
                ['required', 'min:5', 'max:255', Rule::unique('category_translations', 'title')->where(function ($q) use ($langsIDs) {
                    $q->whereNotIn('id', $langsIDs);
                })];
        }

        $request->validate($rules);
        $category->update($request->all());

        return redirect()->route('dashboard.categories.edit', $category_id);
    }

    public function destroy(Request $request, $id)
    {
        $cat = Category::find($id);
        $category = $cat;

        $cat->delete();
        $cat->articles()->detach();

        foreach ($category->articles as $article) {
            if ($article->categories->count() == 0) {
                foreach ($article->images as $image) {
                    Storage::disk('public')->delete($image->path);
                }
                $article->delete();
            }
        }

        return redirect()->route('dashboard.categories.index');
    }
}
