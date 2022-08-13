@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('dashboard.categories.create') }}" class="btn btn-primary mb-3">
            <i class="fas fa-plus"></i>
            {{ __('public.create') }}
        </a>
        <div class="card pt-4 px-4 pb-4">
            <div class="table-responsive">

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('public.title') }}</th>
                            <th scope="col">{{ __('public.description') }}</th>
                            <th scope="col">{{ __('public.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $index => $category)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $category->title }}</td>
                                <td>{{ $category->description ? $category->description : __('public.empty') }}</td>
                                <td class="table-actions">
                                    <a href="{{ route('dashboard.categories.edit', $category->id) }}"
                                        class="btn btn-sm btn-success">{{ __('public.edit') }}</a>
                                    <form action="{{ route('dashboard.categories.destroy', $category->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('{{ __('public.are_you_sure') }}')">{{ __('public.delete') }}</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if (!$categories->count())
                    <h4 class="text-center p-4 text-muted">{{ __('public.empty') }}</h4>
                @endif
            </div>
        </div>



    </div>
@endsection
