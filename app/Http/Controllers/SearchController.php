<?php

namespace App\Http\Controllers;

use App\Models\{Post, Category};
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function post()
    {
        $keyword = request('keyword');
        $categories = Category::latest()->limit(10)->get();
        $posts = Post::where('title', 'like', "%$keyword%")->latest()->paginate(10);
        return view('posts.index', compact('posts', 'categories'));
    }
}
