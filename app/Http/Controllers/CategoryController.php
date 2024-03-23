<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }


    public function create()
    {
        return view('admin.categories.create');
    }


    public function store(Request $request)
    {
        $category = Category::create($request->all());
        return redirect()->route('categories.index');
    }


    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }


    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }


    public function update(Request $request, Category $category)
    {
        $category->update($request->all());
        return redirect()->route('categories.index');
    }


    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index');
    }
}
