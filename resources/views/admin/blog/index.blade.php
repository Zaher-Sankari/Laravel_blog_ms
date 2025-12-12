<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Blogs Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 ">
                    @if ($blogs->count() == 0)
                        <p>No Blogs yet</p>
                        <a href="{{ route('admin.blog.create') }}">Add?</a>
                    @else
                        <p>Available Blogs:</p>
                        <div class="mb-4">
                            @foreach ($blogs as $blog)
                                <div class="mb-4">
                                    <h3>Title: {{ $blog->title }}</h3>
                                    {{-- <h4>Content: {{ $blog->content }}</h4> --}}
                                    <a style="display: inline !important margin-right:10px"
                                        href="{{ route('admin.blog.edit', $blog) }}">Edit</a>
                                    <form style="display: inline !important"
                                        action="{{ route('admin.blog.destroy', $blog) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure?')">delete</button>
                                        <br>
                                    </form>
                                </div> 
                            @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
