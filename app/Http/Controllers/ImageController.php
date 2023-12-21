<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;
use App\Models\Post;

class ImageController extends Controller
{
    public function upload(Request $request, $postId)
    {
        //画像をアップロード
        $imagePath = Storage::disk('s3')->put('images', $request->file('image'));
        
        //アップロード後の画像URLを取得
        $imageUrl = Storage::disk('s3')->url($imagePath);
        
        //画像URLの保存
        $image = new Image([
            'url' => $imageUrl,
        ]);
        
        $post = Post::find($postId);
        $post->image()->save($image);
        
        return redirect()->back()->with('success', '画像がアップロードされました。');
    }
}
