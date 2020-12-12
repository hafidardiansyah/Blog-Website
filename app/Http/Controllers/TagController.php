<?php

namespace App\Http\Controllers;

use App\Models\{Tag, Category};

class TagController extends Controller
{
    public function show(Tag $tag)
    {
        $posts = $tag->posts()->latest()->simplePaginate(10);
        $categories = Category::latest()->limit(10)->get();
        return view('posts.index', compact('posts', 'tag', 'categories'));
    }
}
