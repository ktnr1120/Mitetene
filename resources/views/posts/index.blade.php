<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>みててね</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <!-- Tailwind CSS -->
    <link rel="stylesheet" href="https://npm.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto my-8">
        <h1 class="text-3xl font-bold mb-6">投稿一覧</h1>
        <!-- 新規投稿ボタンのスタイリングをTailwindで行う -->
        <a href='/posts/create' class="bg-blue-500 text-white py-2 px-4 rounded-md inline-block mb-4">新規投稿</a>

        <!-- 投稿一覧の表示 -->
        <div class='posts'>
            @foreach ($posts as $post)
                <div class='post'>
                    <h2 class='title'>
                        <p>{{ $post->created_at->format('Y,m,d') }}</p>
                        <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                    </h2>
                    <!-- 画像があれば表示 -->
                    @if ($post->image)
                        <img src="{{ Storage::disk('s3')->url($post->image->url) }}" alt="Post Image" width="200" height="100">
                    @endif
                </div>
            @endforeach
        </div>

        <!-- ページネーション -->
        <div class='paginate'>
            {{ $posts->links() }}
        </div>
        
        <!-- Reactアプリの表示エリア -->
        <!-- <div id="react-app"></div> -->

        <!-- 削除用スクリプト -->
        <script>
            function deletePost(id) {
                'use strict';
                
                if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
    </div>
</body>
</html>
