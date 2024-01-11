<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Invite') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ url('/invite') }}">
                            @csrf

                            <div class="form-group">
                                <p>大切な人にも子どもの成長を共有しよう！</br>
                                招待したい人のE-mailアドレスを入力して下さい</br>
                                送信されると招待メールが相手へ届きます</p>
                                <label for="email">Eメール:</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-primary">招待する</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
