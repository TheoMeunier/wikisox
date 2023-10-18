<div>
    @foreach($flashs as $flash)
        <div id="toast-{{ $flash['status'] }}" class="alert alert-{{ $flash['status'] }}" role="alert" x-data="{show: true}" x-show="show">
            <div class="alert-icon">
                @if($flash['status'] === 'success')
                    <x-icons.icon-check/>
                @else
                    <x-icons.icon-warning/>
                @endif
            </div>
            <div class="alert-content">{{ $flash['message'] }}</div>
            <button type="button" class="alert-close" x-on:click="show=false" aria-label="Close">
                <x-icons.icon-close/>
            </button>
        </div>
    @endforeach
</div>

