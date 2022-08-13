@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="section-title mb-5">{{ __('public.create_article') }}</h1>

        <form action="{{ route('articles.store') }}" method="POST" id="add-article" enctype="multipart/form-data">
            @csrf

            @foreach (config('translatable.locales') as $locale)
                <h2 class="mt-5 mb-4 section-subtitle">{{ $locale == 'en' ? __('public.english') : __('public.arabic') }}
                </h2>
                <div class="form-group mb-2">
                    <label for="title">{{ __('public.title') }}</label>
                    <input type="text" name="{{ $locale }}[title]" id="title"
                        class="form-control  @error($locale . '.title') is-invalid @enderror"
                        value="{{ old($locale . '.title') }}">

                    @error($locale . '.title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mb-2">
                    <label for="content">{{ __('public.content') }}</label>
                    <textarea name="{{ $locale }}[content]" id="content"
                        class="form-control @error($locale . '.content') is-invalid @enderror">{{ old($locale . '.content') }}</textarea>

                    @error($locale . '.content')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            @endforeach

            <div class="form-group mb-2">
                <label for="categories">{{ __('public.categories') }}</label>
                <select name="categories[]" id="categories" id="select2"
                    class="form-control  @error('categories') is-invalid @enderror" multiple>
                    @endphp
                    @foreach ($categories as $index => $category)
                        <option value="{{ $category->id }}">
                            {{ $category->title }}</option>
                    @endforeach
                </select>
                @error('categories')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="images">{{ __('public.images') }}</label>
                <input type="file" class="form-control @error('images') is-invalid @enderror" name="images[]" multiple>

                @error('images')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                @if (\Session::has('imagesErrors'))
                    <span class="invalid-feedback d-block" role="alert">
                        @foreach (\Session::get('imagesErrors') as $imageError)
                            <strong class="d-block">{{ $imageError }}</strong>
                        @endforeach
                    </span>
                @endif


            </div>

            <button class="btn btn-primary mt-2" id="saveBtn">{{ __('public.create') }}</button>
        </form>

    </div>
@endsection

@section('script')
    <script></script>
@endsection
