<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view('posts.index', [
            'posts' => Post::simplePaginate(3)
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function save(Request $request)
    {
        // * Validate the field
        $attr = $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        // $post = new Post;
        // $post->title = $request->title;
        // $post->slug = Str::slug($request->title);
        // $post->body = $request->body;
        // $post->save();

        // Post::create([
        //     'title' =>  $request->title,
        //     'slug'  =>  Str::slug($request->title),
        //     'body'  =>  $request->body
        // ]);

        // $post = $request->all();
        // $post['slug'] = Str::slug($request->title);
        // Post::create($post);

        // * Assign title to the slug
        $attr['slug'] = Str::slug($request->title);

        // * Create new post
        Post::create($attr);

        // return redirect()->to('/posts/create');
        return back();
    }
}
