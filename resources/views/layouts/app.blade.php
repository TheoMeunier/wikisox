<x-base-layout>
    <div class="min-h-screen" id="app">
        @include('layouts.navigation')
        @include('components._flash')

        <!-- page Content -->
        <main>
            {{ $slot }}
        </main>

        @include('layouts.footer')
    </div>
</x-base-layout>
