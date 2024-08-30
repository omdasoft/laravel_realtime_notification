<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('User/Post/Index', ['posts' => auth()->user()->posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(PostStoreRequest $request)
    {
        $validated = $request->validated();
        $post = new Post();

        if ($request->hasFile('image')) {
            $post->image_url = $request->file('image')->store('images', 'public');
        }

        $post->title = $validated['title'];
        $post->body = $validated['body'];
        $post->user_id = auth()->user()->id;
        $post->save();

        return to_route('user.posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    public function update(PostUpdateRequest $request, Post $post)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $post->image_url = $request->file('image')->store('images', 'public');
        }

        $post->title = $validated['title'];
        $post->body = $validated['body'];
        $post->save(); 

        return to_route('user.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
