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
                    <p class='body'>{{ $post->body }}</p>    
                </div>
            </div>
            @if ($post->image)
                <img src="{{ Storage::disk('s3')->url($post->image->url) }}" alt="Post Image" width="200" heigth="100">
            @endif
            
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
            
            @if($post->children->count() > 0)
                <p><strong>子ども：</strong>
                    @foreach($post->children->unique('id') as $child)
                        {{ $child->name }}ちゃん
                    @endforeach
                </p>
            @else
                <p><strong>子ども：</strong>登録されていません</p>
            @endif


            <div class="edit">
                <a href="/posts/{{ $post->id }}/edit">再編集する</a>
            </div>
            <div class="footer">
                <a href="/">一覧にもどる</a>
            </div>
        </body>
    </x-app-layout>
</html>