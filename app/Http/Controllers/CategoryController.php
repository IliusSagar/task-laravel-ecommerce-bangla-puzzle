<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Traits\CategoryStoreTrait;
use App\Traits\CategoryUpdateTrait;

class CategoryController extends Controller
{
    use CategoryStoreTrait;
    use CategoryUpdateTrait;
    public function index()
    {
        $categories = Category::with(['creator:id,name'])
            ->select('id', 'name', 'slug', 'created_by')
            ->latest()
            ->get();

        return view('backend.category.index', compact('categories'));
    }

    public function create()
    {
        return view('backend.category.create');
    }

    public function store(StoreCategoryRequest $request)
    {

        $this->storeCategory($request);

        return redirect()->route('category.index')->with('success', 'Category created successfully!');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('category.index')->with('success', 'Category deleted successfully!');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('backend.category.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest  $request, $id)
    {
        
        
       $category = Category::findOrFail($id);

        $this->updateCategory($request, $category);

        return redirect()->route('category.index')->with('success', 'Category updated successfully!');
    }
}
