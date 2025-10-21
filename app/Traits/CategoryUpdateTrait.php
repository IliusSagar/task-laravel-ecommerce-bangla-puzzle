<?php

namespace App\Traits;

use App\Models\Category;
use Illuminate\Support\Str;

trait CategoryUpdateTrait
{
    /**
     * Handle the storing of a category.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Models\Category
     */
    public function updateCategory($request, $category)
    {
        return $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'created_by' => auth()->id(),
        ]);
    }
}
