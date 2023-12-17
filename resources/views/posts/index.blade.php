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
        <p>ログインユーザー：{{ Auth::user()->name }}</p>
        <h1>みててね</h1>
        <a href='/posts/create'>投稿</a>
        
        <div class='categories'>
            <h2>カテゴリ一覧</h2>
            <ul>
                @foreach ($categories as $category)
                    <li>{{ $category->name }}</li>
                @endforeach
            </ul>
        </div>
    
        <div class='posts'>
            @foreach ($posts as $post)
                <div class='post'>
                    <h2 class='title'>
                        <p>{{ $post->created_at->format('Y,m,d') }}</p>
                        <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                    </h2>
                    <p class='body'>{{ $post->body }}</p>
                    <h3>カテゴリ:</h3><!-- 12/13現在未実装-->
                    <ul>
                        @if ($post->categories)
                            @foreach ($post->categories as $category)
                                <li>{{ $category->name }}</li>
                            @endforeach
                        @endif
                    </ul>
                    <form action="/posts/{{ $post->id }}" id="form_{{$post->id}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="deletePost({{ $post->id }})">削除</button>
                    </form>
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
