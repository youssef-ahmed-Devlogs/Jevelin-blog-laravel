@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach ($categories as $category)
            <div>{{ $category->title }}</div>
        @endforeach
    </div>
@endsection
