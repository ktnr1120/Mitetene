<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>みててね</title>
</head>
<body>
    <h1>みててね</h1>
    <form action="/posts" method="POST">
        @csrf
        <div class="title">
            <h2>Title</h2>
            <input type="text" name="post[title]" placeholder="タイトル" value="{{ old('post.title') }}"/>
            <p class="title__error" style="color:red">{{ $errors->first('post.title') }}</p>
        </div>
        <div class="body">
            <h2>Body</h2>
            <textarea name="post[body]" placeholder="今日も1日お疲れさまでした。">{{ old('post.body') }}</textarea>
            <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
        </div>

        <!-- 天気情報のセレクトボックス -->
        <div class="weather">
            <h2>Weather</h2>
            <select name="post[weather_id]">
                @foreach ($weathers as $weather)
                    <option value="{{ $weather->id }}">{{ $weather->name }}</option>
                @endforeach
            </select>
        </div>

        <input type="submit" value="保存"/>
    </form>
    <div class="back">[<a href="/">back</a>]</div>
</body>
</html>
