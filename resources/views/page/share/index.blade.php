<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('images/logo.svg') }}" type="image/x-icon">
    <meta name="description" content="Application wiki">
    <meta name="author" content="Théo Meunier">
    <meta name="robots" content="index, follow">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/index.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
<div class="page-wrapper">
    @include('layouts.navigation')
    <main class="container">
        <section>
            <div class="grid grid-cols-5 gap-4">
                <div class="flex flex-col">
                    <div>
                        <h4>{{ __('title.info') }}</h4>
                        <p class="text-gray-500 mt-6 flex items-center gap-2">
                            <x-icons.icon-user class="h-5 w-5"/>
                            {{ __('nav.create_to') }} {{ $page->user->name }}
                        </p>
                        <p class="text-gray-500 mt-6 flex items-center gap-2">
                            <x-icons.icon-clock class="h-5 w-5"/>
                            {{ __('nav.created_at') }} {{ $page->created_at->format('d/m/Y') }}
                        </p>
                    </div>
                </div>

                <div class="col-span-4">
                    <div class="pb-16">
                        <h1>{{ $page->name }}</h1>
                    </div>

                    <div class="formatted" style="max-width: 100%">
                        {!! $page->parse_content !!}
                    </div>
                </div>
            </div>
        </section>
    </main>
    @include('layouts.footer')
</div>
</body>
</html>

