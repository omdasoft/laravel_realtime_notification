<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;
use App\Http\Requests\PostStoreRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PostUpdateRequest;
use App\Services\NotificationService;

class PostController extends Controller
{
    public function __construct(private NotificationService $notificationService)
    {}

    public function index()
    {
        return Inertia::render('User/Post/Index', ['posts' => auth()->user()->posts]);
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

        $this->notificationService->notifyAdminOfNewPost($post);

        return to_route('user.posts.index');
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

    public function destroy(Post $post)
    {
        if ($post->image_url) {
            if (Storage::disk('public')->exists($post->image_url)) {
                Storage::disk('public')->delete($post->image_url);
            }
        }
        
        $post->delete();
    }
}
