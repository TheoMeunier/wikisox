<x-base-layout>
    <div class="dashboard" id="app">
        @include('admin.layouts.navigation')
        @include('components._flash')

        <main class="dashboard__main">
            @include('admin.layouts.sidebar')
            <div class="dashboard__content bg-gray-100">
                {{ $slot }}
            </div>
        </main>
    </div>
</x-base-layout>
