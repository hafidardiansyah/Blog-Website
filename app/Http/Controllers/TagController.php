<?php

namespace App\Http\Controllers;

use App\Models\{Tag, Category};

class TagController extends Controller
{
    public function show(Tag $tag)
    {
        $keyword = '';
        $categories = Category::latest()->limit(10)->get();
        $posts = $tag->posts()->latest()->simplePaginate(10);
        return view('posts.index', compact('posts', 'tag', 'categories', 'keyword'));
    }
}
