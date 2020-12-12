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
            'categories'    => Category::get(),
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
        $request->validate([
            'thumbnail' => 'image|mimes:jpeg,jpg,png|max:1024'
        ]);

        $attr = $request->all();

        $slug = Str::slug($request->title);
        $attr['slug'] = $slug;

        $thumbnail = request()->file('thumbnail') ? $thumbnail = request()->file('thumbnail')->store('images/posts') : null;

        $attr['category_id'] = request('category');
        $attr['thumbnail'] = $thumbnail;

        // * Create new post
        $post = auth()->user()->posts()->create($attr);

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
        $request->validate([
            'thumbnail' => 'image|mimes:jpeg,jpg,png|max:1024'
        ]);

        if (request()->file('thumbnail')) {
            \Storage::delete($post->thumbnail);
            $thumbnail = request()->file('thumbnail')->store('images/posts');
        } else {
            $thumbnail = $post->thumnail;
        }


        $this->authorize('update', $post);
        $attr = $request->all();
        $attr['category_id'] = request('category');
        $attr['thumbnail'] = $thumbnail;

        $post->update($attr);
        $post->tags()->sync(request('tags'));

        session()->flash('success', 'The post was updated.');

        // session()->flash('error', 'The post was updated.');

        return redirect('/posts');
    }

    public function delete(Post $post)
    {
        $this->authorize('delete', $post);

        \Storage::delete($post->thumbnail);
        $post->tags()->detach();
        $post->delete();
        session()->flash('error', "It wasn't your post.");
        return redirect('/posts');
    }
}
