@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-5">
                    <img src="{{ asset("storage/$article->image") }}" alt="">
                    <div class="card-body">
                        <div class="card-info mb-2">
                            <span class="author">{{ $article->user->first_name . ' ' . $article->user->last_name }}</span>
                            <span class="date">{{ $article->created_at }}</span>
                        </div>
                        <h2 class="card-title mb-2">
                            {{ $article->title }}
                        </h2>
                        <p class="card-text">
                            {{ $article->content }}
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
                <hr>
                <h4 class="section-subtitle mb-3 mt-5">{{ __('public.related_articles') }}</h4>

                <div class="row mt-4 mb-5">

                    @foreach ($relatedArticles as $relatedArticle)
                        <div class="col-lg-4">
                            <div class="card">
                                <img src="{{ asset("storage/$relatedArticle->image") }}"
                                    style="height: 200px;object-fit: cover;" alt="">
                                <div class="card-body">
                                    <h5 class="card-title mb-2">
                                        {{ substr($relatedArticle->title, 0, 15) . '...' }}
                                    </h5>
                                    <div class="card-categories">
                                        @foreach ($relatedArticle->categories as $index => $relatedArticleCategory)
                                            <a href="{{ route('index') }}?category={{ $relatedArticleCategory->title }}">
                                                {{ $relatedArticleCategory->title }}
                                                {{ $index < count($relatedArticle->categories) - 1 ? '|' : '' }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <h4 class="section-subtitle mb-3">{{ __('public.leave_a_comment') }}</h4>

                <div class="comments-container">
                    <form action="{{ route('comments.store', $article->id) }}" method="POST">
                        @csrf
                        <textarea name="content" id="comment_input" class="form-control" cols="30" rows="5"></textarea>
                        <button class="btn btn-primary mt-3">{{ __('public.comment') }}</button>
                    </form>
                    <hr>
                    <div class="comments-area mt-4">
                        @foreach ($article->comments as $comment)
                            <div class="comment">
                                <img src="{{ asset('assets/images/articles/1.jpg') }}" alt="">
                                <div class="comment-info">
                                    <h6 class="username">
                                        {{ $comment->user->first_name . ' ' . $comment->user->last_name }}
                                    </h6>
                                    <p class="content">
                                        {{ $comment->content }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
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
