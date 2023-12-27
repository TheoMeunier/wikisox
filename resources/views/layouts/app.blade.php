<x-base-layout>
    <div class="page-wrapper">
        @include('layouts.navigation')
        @include('components._flash')

        <!-- page Content -->
        <main class="container">
            {{ $slot }}
        </main>

        @include('layouts.footer')
    </div>
</x-base-layout>
