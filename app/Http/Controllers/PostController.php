<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Http\Requests\PostRequest;
use App\Models\{Tag, Post, Category};

class PostController extends Controller
{
    public function index()
    {
        return view('posts.index', [
            'posts' => Post::latest()->simplePaginate(9)
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function create()
    {
        return view('posts.create', [
            'post'          => new Post(),
            'categories'    => Category::get(),
            'tags'          => Tag::get(),
        ]);
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
        $attr['category_id'] = request('category');

        // * Create new post
        $post = Post::create($attr);

        $post->tags()->attach(request('tags'));

        session()->flash('success', 'The post was created.');

        // session()->flash('error', 'The post was created.');

        return redirect('/posts');
        // return back();
    }

    public function edit(Post $post)
    {
        return view('posts.edit', [
            'post'          => $post,
            'categories'    => Category::get(),
            'tags'          => Tag::get(),
        ]);
    }

    public function update(PostRequest $request, Post $post)
    {
        $attr = $request->all();
        $attr['category_id'] = request('category');

        $post->update($attr);
        $post->tags()->sync(request('tags'));

        session()->flash('success', 'The post was updated.');

        // session()->flash('error', 'The post was updated.');

        return redirect('/posts');
    }

    public function delete(Post $post)
    {
        $post->tags()->detach();
        $post->delete();
        session()->flash('success', 'The post was deleted.');
        return redirect('/posts');
    }
}
