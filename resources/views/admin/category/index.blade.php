<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Category Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ($categories->count() == 0)
                        <p>No Categories yet</p>
                        <a href="{{ route('admin.category.create') }}">Add?</a>
                    @else
                        <p>Available Categories:</p>
                        @foreach ($categories as $category)
                            <div>{{ $category->name }}</div>
                            <a href="{{ route('admin.category.edit', $category) }}">Edit</a>
                            <form action="{{ route('admin.category.destroy', $category) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure?')">delete</button>
                            </form><br>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
