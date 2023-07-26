<div>
    @foreach($flashs as $flash)
        <div id="toast-{{ $flash['status'] }}" class="alert" role="alert" x-data="{show: true}" x-show="show">
            <div class="alert__icon">
                @if($flash['status'] === 'success')
                    <x-icons.icon-success/>
                @else
                    <x-icons.icon-error/>
                @endif
            </div>
            <div class="alert__content">{{ $flash['message'] }}</div>
            <button type="button" class="alert__close" x-on:click="show=false" aria-label="Close">
                <x-icons.icon-close/>
            </button>
        </div>
    @endforeach
</div>

