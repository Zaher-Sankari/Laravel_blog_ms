
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('List of Favourite Blogs:') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            </div>
        </div>
        <div class="p-6 text-gray-900 dark:text-gray-100">

            <a href="{{ route('home') }}" class="text-blue-500 underline">← Back to Home</a>

            <h3 class="text-2xl font-bold mt-4 mb-6">Your Favorite Blogs:</h3>

            @forelse ($favorites ?? [] as $blog)
                <div class="border dark:border-gray-700 rounded-lg p-4 mb-4 bg-gray-50 dark:bg-gray-900">

                    <h2 class="text-xl font-semibold mb-2">
                        <a href="{{ route('blogs.show', $blog->id) }}"
                            class="text-blue-600 dark:text-blue-400 underline">
                            {{ $blog->title }}
                        </a>
                    </h2>
                    <form action="{{ route('favorites.destroy', $blog->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                            Remove from Favorites
                        </button>
                    </form>
                </div>
            @empty
                <p class="text-gray-600 dark:text-gray-300">You haven't added any favorite blogs yet.</p>
            @endforelse

        </div>
    </div>
</x-app-layout>
