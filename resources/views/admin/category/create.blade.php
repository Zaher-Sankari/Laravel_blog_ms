<style>
    .label-white {
        color: white;
        font-size: 16px;
        
    }
    input{
        width: 100%;
        height: fit-content;
        margin-top:16px !important; 
    }
    .submit {
        margin-top: 16px !important;
        background-color: white;
        padding: 8px 16px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
</style>

<x-app-layout>
<x-guest-layout>
    <form action="{{ route('admin.category.store') }}" method="post">
        @csrf
    <label class="label-white" for="name">Enter Category Name: </label><br>
    <input type="text" id="name" name="name"><br>
    <button class="submit" type="submit">Add</button><br>
    </form>
</x-guest-layout>

</x-app-layout>