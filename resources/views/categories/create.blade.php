@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="section-title mb-5">Categories</h1>

        <form action="{{ route('categories.store') }}" method="POST">
            @csrf

            @foreach (config('translatable.locales') as $locale)
                <h2 class="mt-5 mb-4 section-subtitle">{{ $locale == 'en' ? 'English' : 'Arabic' }}</h2>
                <div class="form-group mb-2">
                    <label for="title">Title</label>
                    <input type="text" name="{{ $locale }}[title]" id="title" class="form-control">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="{{ $locale }}[description]" id="description" class="form-control"></textarea>
                </div>
            @endforeach

            <button class="btn btn-primary mt-2">Save</button>
        </form>
    </div>
@endsection
