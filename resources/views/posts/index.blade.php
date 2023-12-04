<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>みててね</h1>
        <div class='posts'>
            @if(isset($posts) && count($posts) > 0)
                @foreach ($posts as $post)
                    <div class='post'>
                        <h2 class='title'>{{ $post->title }}</h2>
                        <p class='body'>{{ $post->body }}</p>
                    </div>
                @endforeach
            @else
                <p>No posts found.</p>
            @endif
        </div>
        <div class='paginate'>
            {{ $posts->links() }}
        </div>
    </body>
</html>