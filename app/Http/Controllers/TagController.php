<?php

namespace App\Http\Controllers;

use App\Models\Tag;

class TagController extends Controller
{
    public function show(Tag $tag)
    {
        $posts = $tag->posts()->latest()->simplePaginate(9);
        return view('posts.index', compact('posts', 'tag'));
    }
}
