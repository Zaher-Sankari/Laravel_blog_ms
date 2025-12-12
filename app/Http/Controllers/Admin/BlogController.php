<?php
namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\addBlogRequest;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::with('category:name')->get();
        return view('admin.blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::select('id', 'name')->get();
        return view('admin.blog.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(addBlogRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('blogs', 'public');
        }
        $blog = Blog::create($validated);
        return redirect()->route('admin.blog.index')->with('success', 'Blog added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $blog = Blog::with('category:name')->findOrFail($id);
        return view('admin.blog.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $blog = Blog::findOrFail($id);
        $categories = Category::select('id', 'name')->get();
        return view('admin.blog.edit', compact('blog', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $blog = Blog::findOrFail($id);
        $blog->update($request->all());
        return redirect()->route('admin.blog.index')->with('success', 'Blog updated successfully.');
    }

    /**
     * soft Delete the specified resource and move it to trash.
     */
    public function destroy(string $id)
    {
        // Soft delete
        $blog = Blog::findOrFail($id);
        $blog->delete();
        return redirect()->route('admin.blog.index')->with('success', 'Blog deleted successfully.');
    }
    
    /**
     * Display a listing of the trashed resources.
     */
    public function trashed()
    {
        $trashedBlogs = Blog::onlyTrashed()->get();
        return view('admin.blog.trashed', compact('trashedBlogs'));
    }
    
    /**
     * Restore a trashed resource.
     */
    public function restore($id)
    {
        $blog = Blog::onlyTrashed()->findOrFail($id);
        $blog->restore();
        return redirect()->route('admin.blog.index')->with('success', 'Blog restored successfully.');
    }
    /**
     * Permanently delete a trashed resource.
     */
    public function forceDelete($id)
    {
        $blog = Blog::onlyTrashed()->findOrFail($id);
        $blog->forceDelete();
        return redirect()->route('admin.blog.trashed')->with('success', 'Blog permanently deleted successfully.');
    }
}