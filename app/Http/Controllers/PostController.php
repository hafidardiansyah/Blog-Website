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

        session()->flash('success', 'The post was created.');

        // session()->flash('error', 'The post was created.');

        return redirect('/');
        // return back();
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Post $post)
    {
        // * Validate the field
        $attr = request()->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $post->update($attr);
        session()->flash('success', 'The post was updated.');

        // session()->flash('error', 'The post was updated.');

        return redirect('/');
    }
}
