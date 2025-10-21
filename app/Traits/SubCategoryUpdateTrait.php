<?php

namespace App\Traits;

use App\Models\SubCategory;
use Illuminate\Support\Str;

trait SubCategoryUpdateTrait
{
    /**
     * Handle the storing of a category.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Models\SubCategory
     */
    public function updateSubCategory($request, $subcategory)
    {
        return $subcategory->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'created_by' => auth()->id(),
        ]);
    }
}
