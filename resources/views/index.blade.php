@extends('layouts.app')

@section('content')
    {{-- HOME SLIDER --}}
    <div class="home_slider" style="background-image: url({{ asset('assets/images/home_slider/blog_slide1.jpg') }})">
        <div class="hero_section">
            <h1 class="title">{{ __('public.slide_title') }}</h1>
            <p class="text">{{ __('public.slide_text') }}</p>
        </div>
    </div>

    <div class="container">
        {{-- HOME Categories --}}
        <div class="home_categories my-5">
            <a href="/{{ $searchQuery == '' ? '' : '?s=' . $searchQuery }}"
                class="category_link {{ $categoryQuery == 'all' ? 'active' : '' }}">{{ __('public.all') }}</a>
            @foreach ($categories as $category)
                {{-- ?s=design{{ $categoryQuery == 'all' ? '' : '&category=' . $categoryQuery }} --}}
                <a href="{{ route('index') }}?category={{ $category->title }}{{ $searchQuery == '' ? '' : '&s=' . $searchQuery }}"
                    class="category_link {{ $categoryQuery == $category->title ? 'active' : '' }}">
                    {{ $category->title }}
                </a>
            @endforeach
        </div>

        {{-- HOME Content --}}
        <div class="row">
            <div class="col-lg-8">
                <div class="row home-articles">

                    @foreach ($articles as $article)
                        <div class="col-lg-6 mb-4">
                            <div class="card">
                                <img src="{{ asset("storage/$article->image") }}" alt="">
                                <div class="card-body">
                                    <div class="card-info mb-2">
                                        <span
                                            class="author">{{ $article->user->first_name . ' ' . $article->user->last_name }}</span>
                                        <span class="date">{{ $article->created_at }}</span>
                                    </div>
                                    <h2 class="card-title mb-2">
                                        <a href="{{ route('articles.show', $article->id) }}">
                                            {{ substr($article->title, 0, 15) . '...' }}
                                        </a>
                                    </h2>
                                    <p class="card-text">
                                        {{ substr($article->content, 0, 100) . '...' }}
                                    </p>
                                    <div class="card-comments">
                                        <i class="fas fa-comment icon"></i>
                                        <span class="count">
                                            {{ count($article->comments) }}
                                        </span>
                                    </div>
                                    <div class="card-categories">
                                        @foreach ($article->categories as $index => $articleCategory)
                                            <a href="{{ route('index') }}?category={{ $articleCategory->title }}">
                                                {{ $articleCategory->title }}
                                                {{ $index < count($article->categories) - 1 ? '|' : '' }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                {{ $articles->links() }}
            </div>

            <div class="col-lg-4">
                <h4 class="section-subtitle mb-3">{{ __('public.latest_articles') }}</h4>

                @foreach ($latestArticles as $latestArticle)
                    <div class="latest-articles">
                        <img src="{{ asset("storage/$latestArticle->image") }}" alt="">
                        <div class="info">
                            <div class="categories">
                                @foreach ($latestArticle->categories as $index => $latestArticleCategory)
                                    <a href="{{ route('index') }}?category={{ $latestArticleCategory->title }}">
                                        {{ $latestArticleCategory->title }}
                                        {{ $index < count($latestArticle->categories) - 1 ? '|' : '' }}
                                    </a>
                                @endforeach
                            </div>
                            <h5 class="title">
                                <a href="{{ route('articles.show', $latestArticle->id) }}">
                                    {{ substr($latestArticle->title, 0, 15) }}
                                </a>
                            </h5>
                        </div>
                    </div>
                @endforeach

                <h4 class="section-subtitle mb-3 mt-4">{{ __('public.ads') }}</h4>
                <img src="{{ asset('assets/images/ad.png') }}" class="w-100" alt="">
            </div>
        </div>

    </div>
@endsection
