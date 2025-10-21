<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Traits\CategoryStoreTrait;

class CategoryController extends Controller
{
    use CategoryStoreTrait;
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
}
