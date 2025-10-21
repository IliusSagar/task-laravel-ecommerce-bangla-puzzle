<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'subcategory', 'creator'])->latest()->paginate(10);

        return view("backend.product.index", compact("products"));
    }

    public function create()
    {
        $categories = Category::all();
        $subcategories = SubCategory::all();
        return view("backend.product.create", compact("categories", 'subcategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'name' => 'required|max:255|unique:products,name',
            'old_price' => 'nullable|numeric',
            'new_price' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'image' => $imagePath,
            'old_price' => $request->old_price,
            'new_price' => $request->new_price,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('product.index')->with('success', 'Product created successfully!');
    }

    public function getSubcategories($category_id)
    {
        $subcategories = SubCategory::where('category_id', $category_id)
            ->select('id', 'name')
            ->orderBy('name', 'asc')
            ->get();

        return response()->json($subcategories);
    }
}
