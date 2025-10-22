<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductRequest;
use App\Traits\ProductStoreTrait;

class ProductController extends Controller
{
    use ProductStoreTrait;
    public function index()
    {
        $products = Product::with(['category', 'subcategory', 'creator'])->latest()->get();

        return view("backend.product.index", compact("products"));
    }

    public function create()
    {
        $categories = Category::all();
        $subcategories = SubCategory::all();
        return view("backend.product.create", compact("categories", 'subcategories'));
    }

    public function store(StoreProductRequest $request)
    {
       

       $this->storeProduct($request);

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

    public function destroy($id)
    {
        $product = Product::findOrFail($id);


        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }


        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product deleted successfully!');
    }

    public function edit($id)
    {
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $product = Product::findOrFail($id);
        return view('backend.product.edit', compact('categories','subcategories','product'));
    }

     public function update(Request $request,$id)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|max:255|unique:products,name,' . $id,
            'old_price' => 'nullable|numeric',
            'new_price' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

         $product = Product::findOrFail($id);

        $imagePath = $product->image;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product->update([
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

        return redirect()->route('product.index')->with('success', 'Product updated successfully!');
    }
}
