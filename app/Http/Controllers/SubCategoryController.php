<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSubCategoryRequest;
use Illuminate\Support\Str;
use App\Traits\SubCategoryStoreTrait;
use App\Traits\SubCategoryUpdateTrait;


class SubCategoryController extends Controller
{

    use SubCategoryStoreTrait;
    use SubCategoryUpdateTrait;
    public function index()
    {
        $subcategories = SubCategory::with(['category', 'creator'])
            ->latest()
            ->get();
        return view("backend.subcategory.index", compact("subcategories"));
    }

    public function create()
    {
        $categories = Category::all();
        return view("backend.subcategory.create", compact("categories"));
    }

    public function store(StoreSubCategoryRequest $request)
    {
        $this->storeSubCategory($request);

        return redirect()->route('subcategory.index')->with('success', 'Subcategory created successfully!');
    }

    public function destroy($id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $subcategory->delete();

        return redirect()->route('subcategory.index')->with('success', 'SubCategory deleted successfully!');
    }

    public function edit($id)
    {
        $categories = Category::all();
        $subcategories = SubCategory::findOrFail($id);
        return view('backend.subcategory.edit', compact('categories', 'subcategories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|max:255|unique:sub_categories,name,' . $id,
        ]);

        $subcategory = SubCategory::findOrFail($id);

        $this->updateSubCategory($request, $subcategory);

        return redirect()->route('subcategory.index')->with('success', 'Subcategory updated successfully!');
    }
}
