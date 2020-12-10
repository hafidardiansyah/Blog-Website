<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        return view('posts.index', [
            'posts' => Post::simplePaginate(9)
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function create()
    {
        return view('posts.create', ['post' => new Post()]);
    }

    public function save(PostRequest $request)
    {
        // parameter Request $request for active validate the field

        // * Validate the field
        // $attr = $request->validate([
        //     'title' => 'required|min:3',
        //     'body' => 'required',
        // ]);

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

        // * New validate from postrequest
        $attr = $request->all();

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

    public function update(PostRequest $request, Post $post)
    {
        $attr = $request->all();

        $post->update($attr);
        session()->flash('success', 'The post was updated.');

        // session()->flash('error', 'The post was updated.');

        return redirect('/');
    }

    public function delete(Post $post)
    {
        $post->delete();
        session()->flash('success', 'The post was deleted.');
        return redirect('/');
    }
}
