<?php

namespace App\Http\Controllers\Admin\User;
use App\Models\Post;
use Inertia\Inertia;
use App\Enums\PostStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::with('user:id,name')->latest()->get();
        return Inertia::render('Admin/User/Post/Index', ['posts' => $posts]);
    }

    public function updateStatus(Post $post)
    {
        if ($post->status === PostStatus::STATUS_PENDING || $post->status === PostStatus::STATUS_REJECTED) {
            $post->status = PostStatus::STATUS_APPROVED;
        } else {
            $post->status = PostStatus::STATUS_REJECTED;
        }

        $post->save();

        return to_route('admin.users.posts.index');
    }

    public function show(Post $post)
    {
        $post = $post::with('user')->first();
        return Inertia::render('Admin/User/Post/Show', ['post' => $post]);
    }
}
