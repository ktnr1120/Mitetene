<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>みててね</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <x-app-layout>
        <body>
            <h1 class="title">
                <p>{{ $post->created_at->format('Y,m,d') }}</p>
                @if ($post->weather)
                <h2>天気: {{ $post->weather->name }}</h2>
                @else
                    <p>天気情報がありません。</p>
                @endif
                {{ $post->title }}
            </h1>
            <div class="content">
                <div class="content_post">
                    <h3>本文</h3>
                    <p class='body'>{{ $post->body }}</p>    
                </div>
                @if($post->image)
                    <img src="{{ Strage::url($post->image) }}" alt="Post Image">
                @endif
                <a href="{{ route('index') }}">一覧にもどる</a>
            </div>
            @if ($post->categories)
                <h2>カテゴリ:</h2>
                <ul>
                    @foreach ($post->categories as $category)
                        <li>{{ $category->name }}</li>
                    @endforeach
                </ul>
            @else
                <p>カテゴリ情報がありません。</p>
            @endif
            <div class="edit">
                <a href="/posts/{{ $post->id }}/edit">edit</a>
            </div>
            <div class="footer">
                <a href="/">戻る</a>
            </div>
        </body>
    </x-app-layout>
</html>