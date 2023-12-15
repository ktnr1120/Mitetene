<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(Post $post)
    {
        $posts = $post->getPaginateByLimit();
        $categories = Category::all();

        return view('posts.index', compact('posts', 'categories',));
    }

    public function show(Post $post)
    {
        return view('posts.show')->with(['post' => $post]);
    }
    
    public function create()
    {
        $categories = Category::all();
        
        return view('posts.create', compact('categories'));
    }
    
    public function store(PostRequest $request, Post $post)
    {
            // 認証されているユーザーの情報を取得
        $user = Auth::user();
    
        // デバッグ用：ログにユーザー情報を出力
        \Log::info('Logged in user:', ['user' => $user]);
    
        // リクエストから投稿データを取得
        $input = $request['post'];
        
        $input += ['user_id' => $request->user()->id];
    
        // ログインしているユーザーのuser_idを投稿データに設定
        $input['User_ID'] = $user->id;
        
        // ログインしているユーザーのChildren_IDを投稿データに設定
        $input['Children_ID'] = $user->children_id;
         
         // Date カラムを現在の日付に設定
        $input['Date'] = now();
    
        // デバッグ用：ログに投稿データを出力
        \Log::info('Post data:', ['input' => $input]);
    
        // 投稿データを保存
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
        $input_post += ['user_id' => $request->user()->id];
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