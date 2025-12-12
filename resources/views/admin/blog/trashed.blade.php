<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Blogs Dashboard') }}
        </h2>
    </x-slot>

        <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                {{-- view trashed blogs --}}
                    @if ($trashedBlogs->count() == 0)
                        <p>No Trashed Blogs</p>
                        <a href="{{ route('admin.blog.index') }}">Back to blog page</a>
                    @else
                    <p>Trashed Blogs:</p>
                    <div class="mb-4">
                        @foreach ($trashedBlogs as $blog)
                            <div>Title: {{ $blog->title }}</div>
                            <a style="display: inline !important; margin-right:10px" href="{{ route('admin.blog.restore', $blog) }}">Restore</a>
                            <form style="display: inline !important" action="{{ route('admin.blog.forceDelete', $blog) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure? This action is irreversible!')">Permanently Delete</button>
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