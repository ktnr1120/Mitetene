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
            @foreach ($invites as $invite)
                <li>{{ $invite->email }}</li>
                <!-- 他の情報も表示する場合は $invite から適切な属性を取得して表示 -->
            @endforeach
        </ul>
    </div>
</x-app-layout>
