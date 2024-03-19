<!-- resources/views/family/familystructure.blade.php -->

<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="card">
                        <div class="card-header">
                            家族情報
                        </div>
                        <div class="card-body">
                            <ul>
                                @forelse($children as $child)
                                    <li>
                                        {{ $child->name }}
                                        <form action="{{ route('family.destroy', ['id' => $child->id]) }}" method="post" class="d-inline" onsubmit="return confirm('本当に削除しますか？');">

                                            @csrf
                                            @method('DELETE')
                                            <p style="color: red;"><button type="submit" class="btn btn-danger">削除</button></p>
                                        </form>
                                    </li>
                                @empty
                                    <li>対象の子どもが追加されていません</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>

                    <div class="card mt-4">
                        <div class="card-header">
                            追加する子どもの名前
                        </div>
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form action="{{ route('family.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="name">子どもの名前:</label>
                                    <input type="text" name="name" id="name" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-primary">追加</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
