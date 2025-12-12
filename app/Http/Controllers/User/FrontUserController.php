<?php

namespace App\Http\Controllers\User;

use App\Models\Blog;
use App\Models\Category;
use App\Http\Controllers\Controller;

class FrontUserController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('category')->latest()->paginate(3);
        $categories = Category::select('id', 'name')->get();
        return view('user.blogs.index', compact('blogs', 'categories'));
    }

    public function show(string $id)
    {
        $blog = Blog::with('category')->findOrFail($id);
        
        return view('user.blogs.show', compact('blog'));
    }

    public function filterByCategory($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $blogs = $category->posts()->with('category')->latest()->paginate(3);
        $categories = Category::select('id', 'name')->get();

        return view('user.blogs.index', compact('blogs', 'categories', 'category'));
    }
}
