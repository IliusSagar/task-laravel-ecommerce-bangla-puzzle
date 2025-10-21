<?php

namespace App\Traits;

use App\Models\SubCategory;
use Illuminate\Support\Str;

trait SubCategoryStoreTrait
{
    /**
     * Handle the storing of a category.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Models\SubCategory
     */
    public function storeSubCategory($request)
    {
        return SubCategory::create([
            'category_id' => $request->category_id,
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'created_by'  => auth()->id(),
        ]);
    }
}
