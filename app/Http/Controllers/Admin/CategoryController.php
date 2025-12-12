<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\addCategoryRequest;
use App\Http\Requests\updateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::select('id', 'name')->get();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(addCategoryRequest $request)
    {
        $validated = $request->validated();
        Category::create($validated);
        return redirect()->route('admin.category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('admin.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateCategoryRequest $request, Category $category)
    {
        $validated = $request->validated();
        $category->update($validated);
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.category.index');
    }
}
