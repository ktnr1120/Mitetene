<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Weather;
use App\Models\Image;
use App\Models\Child;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\ImageController;

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
        $weathers = Weather::all();
        $children = Child::all();
        
        return view('posts.create', compact('categories', 'weathers','children'));
    }
    
    public function store(PostRequest $request)
    {
        // 認証されているユーザーの情報を取得
        $user = Auth::user();
    
        // デバッグ用：ログにユーザー情報を出力
        \Log::info('Logged in user:', ['user' => $user]);
        \Log::info('User ID:', ['user_id' => $request->user()->id]);
        
        //Postモデルからインスタンス作成
        $post = new Post();
    
        // リクエストから投稿データを取得
        $input = $request['post'];
        // dd($request['post']);
    
        $input += [
            'user_id' => $request->user()->id,
            'weather_id' => $request->input('weather_id'),
            ];
        
        //データベースに新しい子どもを作成
        $child = auth()->user()->children()->create([
            'name' => $input['child_name'],
        ]);
        
        //投稿データに子どものIDを追加
        $input['child_id'] = $child->id;
        
        // Date カラムを現在の日付に設定
        $input['Date'] = now();
        
        // 天気情報を取得
        $weatherId = $request->input('weather_id');
        $weather = Weather::find($weatherId);
        
        // 天気情報を投稿データに組み込む
        $input['weather_id'] = $weather->id;
        
    
        // 投稿データを保存
        $post->fill($input)->save();
        
        // [画像アップロード処理]画像がフォームで送信されたかどうかを確認
        // dd($request->file('post.image'));
        if ($request->hasFile('post.image')) {
            // フォームから送信された画像をS3ストレージの'images'ディレクトリに保存
            $imagePath = $request->file('post.image')->store('mitetene0809/image','s3');
            // コードの適切な位置に追加
            //\Log::info('Generated S3 URL:', ['url' => Storage::disk('s3')->url('mitetene0809/image/' . $post->image->url)]);

            // デバッグ用：ファイルが正しくアップロードされたか確認
            // dd($uploadedFile, $uploadedFile->getClientSize(), $uploadedFile->getMimeType());
            
            // バリデーションを通過したデータを取得
            $validatedData = $request->validated();
        
            //Imageモデルを使って　imagesテーブルに保存
            $image = new Image([
                'url' => $imagePath,
            ]);
            
            //対応する投稿に画像を紐づけ
            $post->image()->save($image);
        
            
            //dd($image);
            // $image->id が存在する場合のみログに記録
            if ($image->id) {
                \Log::info('Image saved:', ['image_id' => $image->id]);
            } else {
                \Log::info('Image saved, but image_id id not available');
            }
        }
        
        // 選択されたカテゴリを中間テーブルに紐付ける
        $post->categories()->sync($request->input('categories', []));
        
        return redirect('/posts/' . $post->id);
    }
    
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }
    
    public function update(PostRequest $request, Post $post)
    {
        $input_post = $request['post'];
        $input_post += ['user_id' => $request->user()->id];
        
        $post->fill($input_post)->save();
        
        // カテゴリの同期処理
        $post->categories()->sync($request->input('categories', []));
        
        return redirect('/posts/' . $post->id);
    }
    
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/');
    }
}
?>