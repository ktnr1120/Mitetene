<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        // カテゴリ一覧を取得
        $categories = Category::all();

        // 投稿一覧を取得
        $posts = Post::paginate(10); // 適切なページネーション数を設定

        return view('categories.index', compact('categories', 'posts'));
    }
}
