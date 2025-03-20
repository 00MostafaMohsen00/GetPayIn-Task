<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;

class PostController extends Controller
{
    public $categories, $statusLabels;

    public function __construct()
    {
        $this->statusLabels = Post::statusText();
    }
    public function index()
    {
        $filters = request()->all();

        $posts = auth()->user()->posts()->filter($filters)->paginate(10);
        $statusLabels = $this->statusLabels;
        return inertia('Posts/Index', get_defined_vars());
    }

    public function create()
    {

        return inertia('Posts/Create', get_defined_vars());
    }


    public function store(PostRequest $request)
    {
        $data = $request->validated();

        auth()->user()->posts()->create($data);

        return redirect()->route('posts.index')->with('success', 'Post created successfully');
    }


    public function edit(string $id)
    {
        $post = auth()->user()->posts()->editable()->findOrFail($id);

        return inertia('Posts/Edit', get_defined_vars());
    }


    public function update(PostRequest $request, string $id)
    {
        $post = auth()->user()->posts()->editable()->findOrFail($id);
        $data = $request->validated();
        $post->update($data);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully');
    }


    public function destroy(string $id)
    {
        $task = auth()->user()->posts()->findOrFail($id);
        $task->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
    }
}
