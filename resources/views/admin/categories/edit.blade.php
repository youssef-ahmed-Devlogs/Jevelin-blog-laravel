@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="section-title mb-5">{{ __('public.edit_category') }}</h1>

        <form action="{{ route('dashboard.categories.update', $category_id) }}" method="POST">
            @csrf
            @method('patch')
            @foreach (config('translatable.locales') as $index => $locale)
                <h2 class="mt-5 mb-4 section-subtitle">{{ $locale == 'en' ? __('public.english') : __('public.arabic') }}
                </h2>
                <div class="form-group mb-2">
                    <label for="title">{{ __('public.title') }}</label>
                    <input type="text" name="{{ $locale }}[title]" id="title"
                        class="form-control @error($locale . '.title') is-invalid @enderror"
                        value="{{ old($locale . '.title') ? old($locale . '.title') : $category[$locale]['title'] }}">

                    @error($locale . '.title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">{{ __('public.description') }}</label>
                    <textarea name="{{ $locale }}[description]" id="description"
                        class="form-control @error($locale . '.description') is-invalid @enderror">{{ old($locale . '.description') ? old($locale . '.description') : $category[$locale]['description'] }}</textarea>
                    @error($locale . '.description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            @endforeach

            <button class="btn btn-primary mt-2">{{ __('public.edit') }}</button>
        </form>
    </div>
@endsection
