<x-app-layout>
<x-guest-layout>
    <form action="{{ route('admin.category.update',$category) }}" method="post">
        @csrf
        @method('PUT')
    <label for="name">Enter Category Name</label>
    <input type="text" id="name" name="name" value="{{ $category->name }}">
    <button type="submit">update</button>
    </form>
</x-guest-layout>

</x-app-layout>