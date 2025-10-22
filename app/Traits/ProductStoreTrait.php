<?php

namespace App\Traits;

use App\Models\Product;
use Illuminate\Support\Str;

trait ProductStoreTrait
{
    /**
     * Handle the storing of a category.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Models\Product
     */
   public function storeProduct($request)
    {

         $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }
        
        return Product::create([
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
    }
}
