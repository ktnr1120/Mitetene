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
                    @if($post->image)
                        <img src="{{ Storage::url($post->image) }}" alt="Current Post Image">
                        <label for="image">新しい画像選択：</label>
                        <input type="file" name="post[image]" accept="image/*">
                        <label>
                            <input type="checkbox" name="remove_image">画像を削除
                        </label>
                    @else
                        <label for="image">画像選択:</label>
                        <input type="file" name="post[image]" accept="image/*" required>
                    @endif

                    <!-- Add your category checkboxes here -->
                    <div class="form-group">
                        <label for="categories">Categories:</label>
                        @foreach ($categories as $category)
                            <input type="checkbox" name="categories[]" value="{{ $category->id }}" {{ in_array($category->id, $post->categories->pluck('id')->toArray()) ? 'checked' : '' }}>
                            {{ $category->name }}
                        @endforeach
                    </div>

                    <button type="submit">更新</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
