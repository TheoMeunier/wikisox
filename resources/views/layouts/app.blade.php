<x-base-layout>
    <div id="app">
        @include('layouts.navigation')
        @include('components._flash')

        <!-- page Content -->
        <main class="min-h-[83.5vh]">
            {{ $slot }}
        </main>

        @include('layouts.footer')
    </div>
</x-base-layout>
