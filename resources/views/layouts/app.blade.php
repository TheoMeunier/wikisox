<x-base-layout>
    <div class="min-h-screen bg-gray-100" id="app">
        @include('layouts.navigation')
        @include('components._flash')

        <!-- page Heading -->
        <header class="bg-white shadow">
            <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>

        <!-- page Content -->
        <main class="py-14 max-w-8xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            {{ $slot }}
        </main>
    </div>
</x-base-layout>
