<x-base-layout>
    <body class="font-sans antialiased">
    <div class="dashboard" id="app">
        @include('admin.layouts.navigation')

        <main class="dashboard__main">
            @include('admin.layouts.sidebar')
            <div class="dashboard__content bg-gray-100">
                {{ $slot }}
            </div>
        </main>
    </div>
    </body>
</x-base-layout>
