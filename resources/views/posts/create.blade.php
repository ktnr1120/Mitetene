<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>みててね</title>
</head>
<x-app-layout>
    <body>
        <h1>みててね</h1>
        <form action="/posts" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="weather">天気</label>
                <select name="weather_id" class="form-control">
                    @foreach ($weathers as $weather)
                        <option value="{{ $weather->id }}">{{ $weather->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="title">
                <h2>タイトル</h2>
                <input type="text" name="post[title]" placeholder="タイトル" value="{{ old('post.title') }}"/>
                <p class="title__error" style="color:red">{{ $errors->first('post.title') }}</p>
            </div>
            <div class="body">
                <h2>本文</h2>
                <textarea name="post[body]" placeholder="今日も1日お疲れさまでした。">{{ old('post.body') }}</textarea>
                <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
            </div>
            <div class="form-group">
                <label for="post-image">画像選択</label>
                <input type="file" id="post-image" name="post[image]" required>
                @if (@$errors->has('post.image'))
                    <p style="color: red;">{{ @$errors->first('post.image') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="categories">カテゴリー</label>
                @foreach ($categories as $category)
                    <input type="checkbox" name="categories[]" value="{{ $category->id }}" {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}>
                    <label>{{ $category->name }}</label>
                @endforeach
            </div>
            

                @if($userChildren->count() > 0)
                    <!-- ユーザーが子どもを1人以上登録している場合の処理 -->
                    <div class="form-group">
                        <label for="children">子ども</label>
                        @foreach($userChildren as $child)
                            <input type="checkbox" name="children[]" value="{{ $child->id }}">
                            <label>{{ $child->name }}</label><br>
                        @endforeach
                    </div>
                @elseif($userChildren->count() == 1)
                    <!-- ユーザーが子どもを登録していない場合の処理 -->
                    @php
                        $child = $userChildren->first();
                    @endphp
                    <input type="hidden" name="children[]" value="{{ $child->id }}">
                    <p>登録した1人: {{ $child->name }}</p>
                @else
                    <!-- ユーザーが子どもを一切登録していない場合の処理　-->
                    <p>子どもが登録されていません</p>
                @endif

            <input type="submit" value="保存"/>
        </form>
        <div class="back">[<a href="/">back</a>]</div>
    </body>
</x-app-layout>
</html>
