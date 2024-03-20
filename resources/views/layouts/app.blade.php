<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="text-gray-600 body-font">
              <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
                <a class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-10 h-10 text-white p-2 bg-indigo-500 rounded-full" viewBox="0 0 24 24">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                  </svg>
                  <span class="ml-3 text-xl">
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">みててねにようこそ</font>
                    </font>
                  </span>
                </a>
                <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
                  <a class="mr-5 hover:text-gray-900">
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">最初のリンク</font>
                    </font>
                  </a>
                  <a class="mr-5 hover:text-gray-900">
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">2 番目のリンク</font>
                    </font>
                  </a>
                  <a class="mr-5 hover:text-gray-900">
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">3番目のリンク</font>
                    </font>
                  </a>
                  <a class="mr-5 hover:text-gray-900">
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">4番目のリンク</font>
                    </font>
                  </a>
                </nav>
                <button class="inline-flex items-center bg-gray-100 border-0 py-1 px-3 focus:outline-none hover:bg-gray-200 rounded text-base mt-4 md:mt-0">
                  <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">ボタン</font>
                  </font>
                  <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-1" viewBox="0 0 24 24">
                    <path d="M5 12h14M12 5l7 7-7 7"></path>
                  </svg>
                </button>
              </div>
            </header>
                        {{ $header }}
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
