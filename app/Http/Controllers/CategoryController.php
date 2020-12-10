<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $posts = $category->posts()->simplePaginate(9);
        return view('posts.index', compact('posts', 'category'));
    }
}
