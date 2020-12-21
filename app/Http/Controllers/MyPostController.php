<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class MyPostController extends Controller
{
    public function index()
    {
        $posts = Post::where('user_id', Auth::user()->id)->simplePaginate(6);
        return view('posts.my-post', compact('posts'));
    }
}
