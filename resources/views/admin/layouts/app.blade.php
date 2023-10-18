<x-base-layout>
    <div class="dashboard-page">
        @include('admin.layouts.sidebar')

        <main class="dashboard-body">
            {{ $slot }}
        </main>
    </div>
</x-base-layout>
