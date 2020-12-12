<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $categories = Category::latest()->limit(10)->get();
        $posts = $category->posts()->latest()->simplePaginate(10);
        return view('posts.index', compact('posts', 'category','categories'));
    }
}
