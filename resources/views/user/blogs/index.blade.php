@extends('user.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="mb-4">
                @if (isset($category))
                    <h1>List of blogs in -> {{ $category->name }}</h1>
                @else
                    <h1>All Blogs:</h1>
                @endif
            </div>

            @forelse($blogs as $blog)
                <div class="card mb-4">
                        <img src="{{ asset('storage/' . $blog->image) }}" class="card-img-top" alt="{{ $blog->title }}"
                            style="height: 300px; object-fit: cover;">
                    <div class="card-body">
                        <h2 class="card-title">
                            <a href="{{ route('blogs.show', $blog->id) }}" class="text-decoration-none">
                                {{ $blog->title }}
                            </a>
                        </h2>

                        <p class="card-text">
                            {{ Str::limit(strip_tags($blog->content), 200) }}
                        </p>

                        <div class="mb-3">
                            @foreach ($blog->category as $category)
                                <span class="badge bg-primary me-1">
                                    {{ $category->name }}
                                </span>
                            @endforeach
                        </div>

                        @auth
                            @php
                                $isFavorite = auth()->user()->favoriteBlogs->contains($blog->id);
                            @endphp

                            @if (!$isFavorite)
                                <form action="{{ route('favorites.store', $blog->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-outline-danger btn-sm">
                                        ❤️ Add to Favorites
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('favorites.destroy', $blog->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        ❌ Remove Favorite
                                    </button>
                                </form>
                            @endif
                        @endauth

                        <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-primary ms-2">
                            Read More
                        </a>

                    </div>
                </div>
            @empty
                <div class="alert alert-info">
                    No Blogs found.
                </div>
            @endforelse

            @if ($blogs->hasPages())
                <div class="text-center mt-4">
                    @if (!$blogs->onFirstPage())
                        <a href="{{ $blogs->previousPageUrl() }}" class="btn btn-primary me-2">
                            ← Previous Page
                        </a>
                    @endif
                    @if ($blogs->hasMorePages())
                        <a href="{{ $blogs->nextPageUrl() }}" class="btn btn-primary">
                            Next Page →
                        </a>
                    @endif
                </div>
            @endif

        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>Categories</h5>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        <a href="{{ route('home') }}"
                            class="list-group-item list-group-item-action {{ !isset($category) ? 'active' : '' }}">
                            All Categories
                        </a>
                        @foreach ($categories as $cat)
                            <a href="{{ route('blogs.category', $cat->id) }}"
                                class="list-group-item list-group-item-action {{ isset($category) && $category->id == $cat->id ? 'active' : '' }}">
                                {{ $cat->name }}
                                <span class="badge bg-secondary float-end">
                                    {{ $cat->count() }}
                                </span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
