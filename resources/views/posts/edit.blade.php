<!-- resources/views/posts/edit.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Post
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h1>Edit Post</h1>

                <form action="{{ route('update', $post->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="post[title]" value="{{ $post->title }}">
                    </div>

                    <div class="form-group">
                        <label for="body">Body</label>
                        <textarea name="post[body]">{{ $post->body }}</textarea>
                    </div>
                    <div class="form-group">
                        @if($post->image)
                            <img src="{{ Storage::disk('s3')->url($post->image->url) }}" alt="Post Image" width="200" heigth="100">
                            <label for="image">新しい画像選択：</label>
                            <input type="file" id="post-image" name="post[image]" accept="image/*">
                        @else
                            <label for="post-image">画像選択</label>
                            <input type="file" id="post-image" name="post[image]" required>
                        @endif
                        @if (@$errors->has('post.image'))
                            <p style="color: red;">{{ @$errors->first('post.image') }}</p>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="categories">Categories:</label>
                        @foreach ($categories as $category)
                            <input type="checkbox" name="categories[]" value="{{ $category->id }}" {{ in_array($category->id, $post->categories->pluck('id')->toArray()) ? 'checked' : '' }}>
                            {{ $category->name }}
                        @endforeach
                    </div>
                    
                    <!-- 子ども情報を表示し、編集できるセクション -->
                    <div class="form-group">
                        <label for="children">子ども</label>
                        @foreach($userChildren as $child)
                            <input type="checkbox" name="children[]" value="{{ $child->id }}" {{ in_array($child->id, $post->children->pluck('id')->toArray()) ? 'checked' : '' }}>
                            <label>{{ $child->name }}</label><br>
                        @endforeach
                    </div>

                    <button type="submit">更新</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
