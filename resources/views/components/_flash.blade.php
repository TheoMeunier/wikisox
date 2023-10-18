<div class="alerts-wrapper">
    @if (Session::has('success'))
        <div id="toast-success" class="alert alert-success" role="alert" x-data="{show: true}" x-show="show">
            <div class="alert-icon">
                <x-icons.icon-check/>
            </div>
            <div class="alert-content">{{ session('success') }}</div>
            <button type="button" class="alert-close" x-on:click="show=false" aria-label="Close">
                <x-icons.icon-close/>
            </button>
        </div>
    @endif

    @if (Session::has('error'))
        <div id="toast-danger" class="alert alert-danger" role="alert" x-data="{show: true}" x-show="show">
            <div class="alert-icon">
                <x-icons.icon-warning/>
            </div>
            <div class="alert-content">{{ session('error') }}</div>
            <button type="button"  class="alert-close" x-on:click="show=false" aria-label="Close">
                <x-icons.icon-close/>
            </button>
        </div>
    @endif

    @if (Session::has('warning'))
        <div id="toast-warning" class="alert alert-warning" role="alert" x-data="{show: true}" x-show="show">
            <div class="alert-icon">
                <x-icons.icon-warning/>
            </div>
            <div class="alert-content">{{ session('warning') }}</div>
            <button type="button"  class="alert-close" x-on:click="show=false" aria-label="Close">
                <x-icons.icon-close/>
            </button>
        </div>
    @endif


    @livewire('components.flash-message-livewire')
</div>
