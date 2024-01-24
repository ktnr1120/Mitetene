<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p>{{ __("ようこそ!") }}{{ Auth::user()->name }}{{ __("さん") }}</p>
                    <p>みててねでは、子どもの成長記録を投稿して家族で楽しむアプリとなっています</br>
                    子どもは、親に見て！と言います、大人にとっては経験済みのことでも、子どもは初めての経験です</br>
                    そんな些細なことでも、記録してあげて将来子どもと一緒に成長記録を一緒に見返すのも</br>
                    きっと子育ての楽しみになると思います。</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
