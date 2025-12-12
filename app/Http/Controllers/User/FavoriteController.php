<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = Auth::user()->favoriteBlogs()->latest()->get();

        return view('dashboard', compact('favorites'));
    }

    public function store($blogId)
    {
        $blog = Blog::findOrFail($blogId);

        Auth::user()->favoriteBlogs()->syncWithoutDetaching([$blog->id]);

        return redirect()->back();
    }

    public function destroy($blogId)
    {
        Auth::user()->favoriteBlogs()->detach($blogId);

        return redirect()->back();
    }
}
