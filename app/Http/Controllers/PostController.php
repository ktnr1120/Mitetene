<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Weathers;
use App\Models\Category;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    public function index(Post $post)
    {
        $weathers = Weathers::all();
        $posts = $post->getPaginateByLimit();
        $categories = Category::all();

        return view('posts.index', compact('posts', 'categories', 'weathers'));
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
    
    public function create()
    {
        $weathers = Weather::all();
        
        return view('posts.create', compact('weathers'));
    }
    
    public function store(PostRequest $request, Post $post)
    {
        $input = $request['post'];
        $post->fill($input)->save();
        return redirect('/posts/' . $post->id);
    }
    
    public function edit(Post $post)
    {
        return view('posts.edit')->with(['post'=> $post]);
    }
    
    public function update(PostRequest $request, Post $post)
    {
        $input_post = $request['post'];
        $post->fill($input_post)->save();
        
        return redirect('/posts/', $post->id);
    }
    
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/');
    }
}
?>