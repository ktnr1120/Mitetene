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
    try {
        //既存しない場合のみディレクトリを作成
        if (!Storage::disk('s3')->exists("posts/{$postId}")) {
            Storage::disk('s3')->makeDirectory("posts/{$postId}");
        }

        // 画像のバリデーション
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        // 画像をアップロード
        $imagePath = Storage::disk('s3')->put("posts/{$postId}", $request->file('image'));

        // 画像URLの保存
        $imageUrl = Storage::disk('s3')->url($imagePath);

        // SoftDeletesを使っている場合、deleteされていない画像を確認
        $existingImage = Image::where('post_id', $postId)->whereNull('deleted_at')->first();

        if ($existingImage) {
            // 既存の画像があれば、それを更新または削除するかどうかの処理を追加
        }

        // 画像URLの保存
        $image = new Image([
            'url' => $imageUrl,
        ]);

        // 対応する投稿に画像を紐づけ
        $post = Post::find($postId);
        $post->image()->save($image);

        return redirect()->back()->with('success', '画像がアップロードされました.');
    } catch (\Exception $e) {
        // 具体的な例外クラスとスタックトレースをログに記録
        \Log::error('Image upload failed: ' . get_class($e) . PHP_EOL . $e->getTraceAsString());

        // ユーザーに対しては簡潔なエラーメッセージを表示
        return redirect()->back()->with('error', '画像のアップロードに失敗しました。');
    }
}
