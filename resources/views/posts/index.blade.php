<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>みててね</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>
<x-app-layout>
    <body>
        <a href='/posts/create'>投稿</a>
        <!--
        <div class='categories'>
            <h2>カテゴリ一覧</h2>
            <ul>
                @foreach ($categories as $category)
                    <li>{{ $category->name }}</li>
                @endforeach
            </ul>
        </div>
        -->
    
        <div class='posts'>
            @foreach ($posts as $post)
                <div class='post'>
                    <h2 class='title'>
                        <p>{{ $post->created_at->format('Y,m,d') }}</p>
                        <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                    </h2>
                    <!-- 画像があれば表示 -->
                        @if ($post->image)
                            <img src="{{ Storage::disk('s3')->url($post->image->url) }}" alt="Post Image" width="200" heigth="100">
                        @endif
                    <!--<h3>カテゴリ:</h3>-->
                    <!--<ul>-->
                    <!--    @if ($post->categories)-->
                    <!--        @foreach ($post->categories as $category)-->
                    <!--            <li>{{ $category->name }}</li>-->
                    <!--        @endforeach-->
                    <!--    @endif-->
                    <!--</ul>-->
                    <!--<form action="/posts/{{ $post->id }}" id="form_{{$post->id}}" method="post">-->
                    <!--    @csrf-->
                    <!--    @method('DELETE')-->
                    <!--    <p style="color: red;"><button type="button" onclick="deletePost({{ $post->id }})">削除</button></p>-->
                    <!--</form>-->
                </div>
            @endforeach
        </div>
    
        <div class='paginate'>
            {{ $posts->links() }}
        </div>
    
        <script>
            function deletePost(id) {
                'use strict'
                
                if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
    </body>
</x-app-layout>
</html>