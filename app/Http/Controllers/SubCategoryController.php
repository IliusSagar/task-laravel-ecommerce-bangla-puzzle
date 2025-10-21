<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSubCategoryRequest;
use Illuminate\Support\Str;
use App\Traits\SubCategoryStoreTrait;


class SubCategoryController extends Controller
{

    use SubCategoryStoreTrait;
    public function index()
    {
         $subcategories = SubCategory::with(['category','creator'])
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
}
