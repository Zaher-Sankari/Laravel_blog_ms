@extends('user.layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <article>
                @if ($blog->image)
                    <img src="{{ asset('storage/' . $blog->image) }}" class="img-fluid rounded mb-4" alt="{{ $blog->title }}">
                @endif
                <h1 class="mb-3">{{ $blog->title }}</h1>
                <div class="mb-4">
                    @foreach ($blog->category as $category)
                        <span class="badge bg-primary me-1">
                            {{ $category->name }}
                        </span>
                    @endforeach
                </div>

                <div class="blog-content">
                    {!! nl2br(e($blog->content)) !!}
                </div>

                <div class="mt-4 pt-4 border-top">
                </div>
            </article>
        </div>
    </div>
@endsection
