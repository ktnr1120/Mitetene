<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('招待') }}
        </h2>
    </x-slot>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">招待メールが送信されました</div>
    
                        <div class="card-body">
                            <p>招待メールが正常に送信されました。相手が招待を受け入れるまでお待ちください。</p>
                            <p style="color: red;"><a href="{{ route('form') }}">招待ページに戻る</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</x-app-layout>