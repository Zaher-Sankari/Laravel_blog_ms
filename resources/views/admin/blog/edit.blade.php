<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Blog') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (session('success'))
                        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.blog.update', $blog) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Category Selection as Checkboxes -->
                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Categories</label>
                            @error('categories')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror

                            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 mt-2">
                                @php
                                    $selected = old('categories', isset($blog) ? $blog->category->pluck('id')->toArray() : []);
                                @endphp
                                @foreach ($categories as $category)
                                    <div class="flex items-center">
                                        <input type="checkbox" name="categories[]" id="category_{{ $category->id }}"
                                            value="{{ $category->id }}"
                                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                            {{ in_array($category->id, $selected) ? 'checked' : '' }}>
                                        <label for="category_{{ $category->id }}"
                                            class="ml-2 block text-sm text-gray-900">
                                            {{ $category->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <p class="text-gray-500 text-sm mt-2">Select one or more categories</p>
                        </div>

                        <!-- Title Field -->
                        <div class="mb-6">
                            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title</label>
                            <input type="text" name="title" id="title"
                                class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('title') border-red-500 @enderror"
                                value="{{ old('title', $blog->title) }}" required>
                            @error('title')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Content Field -->
                        <div class="mb-6">
                            <label for="content" class="block text-gray-700 text-sm font-bold mb-2">Content</label>
                            <textarea name="content" id="content"
                                class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('content') border-red-500 @enderror"
                                rows="10" required>{{ old('content', $blog->content) }}</textarea>
                            @error('content')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Image Upload -->
                        <div class="mb-6">
                            <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Image</label>
                            @if(!empty($blog->image))
                                <div class="mb-2">
                                    <img src="{{ asset('storage/'.$blog->image) }}" alt="blog image" class="w-48 h-auto">
                                </div>
                            @endif

                            <input type="file" name="image" id="image"
                                class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('image') border-red-500 @enderror"
                                >
                            @error('image')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Update Blog
                            </button>
                            <a href="{{ route('admin.dashboard') }}"
                                class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
