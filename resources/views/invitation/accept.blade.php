{{-- resources/views/invitation/accept.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ゲストユーザー登録') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">ゲストユーザー登録</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('guest.register', ['token' => $token]) }}">
                            @csrf

                            {{-- 名前 --}}
                            <div class="mb-3">
                                <label for="name" class="form-label">ユーザーネーム</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>

                            {{-- メールアドレス --}}
                            <div class="mb-3">
                                <label for="email" class="form-label">メールアドレス</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>

                            {{-- パスワード --}}
                            <div class="mb-3">
                                <label for="password" class="form-label">パスワード</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>

                            {{-- 確認用パスワード --}}
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">確認用パスワード</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-primary">登録</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>