<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Diagram: Get()
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    // Show the form to create a new category
    public function create()
    {
        return view('categories.create');
    }

    // Diagram: Store()
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Save to DB
        Category::create([
            'name' => $request->name,
            'is_active' => true,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    // Diagram: Edit(int id) - Show form
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    // Diagram: Update(int id)
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update([
            'name' => $request->name,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    // Diagram: Delete(int id)
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}