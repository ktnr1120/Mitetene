<!-- resources/views/authenticated-users/authenticate.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('お友達') }}
        </h2>
    </x-slot>

    <div>
        <h3>招待されたユーザー</h3>
        <ul>
            @foreach (Auth::user()->friends as $friend)
                <p>{{ $friend->name }}</p>
            @endforeach
        </ul>
    </div>
</x-app-layout>
