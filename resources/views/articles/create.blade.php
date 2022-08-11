@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="section-title mb-5">{{ __('public.create_article') }}</h1>

        <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @foreach (config('translatable.locales') as $locale)
                <h2 class="mt-5 mb-4 section-subtitle">{{ $locale == 'en' ? __('public.english') : __('public.arabic') }}
                </h2>
                <div class="form-group mb-2">
                    <label for="title">{{ __('public.title') }}</label>
                    <input type="text" name="{{ $locale }}[title]" id="title" class="form-control">
                </div>

                <div class="form-group mb-2">
                    <label for="content">{{ __('public.content') }}</label>
                    <textarea name="{{ $locale }}[content]" id="content" class="form-control"></textarea>
                </div>
            @endforeach

            <div class="form-group mb-2">
                <label for="categories">{{ __('public.categories') }}</label>
                <select name="categories[]" id="categories" class="form-control" multiple>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="image">{{ __('public.image') }}</label>
                <input type="file" class="form-control" name="image">
            </div>

            <button class="btn btn-primary mt-2">{{ __('public.create') }}</button>
        </form>
    </div>
@endsection
