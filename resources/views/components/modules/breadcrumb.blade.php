<div class="breadcrumb" aria-label="Breadcrumb">
    <ol class="breadcrumb__content">
        <li class="breadcrumb__menu">
            <a href="{{ route('dashboard') }}">
                Home
            </a>
        </li>
        @foreach($breadcrumbs as $breadcrumb)
            @if($breadcrumb->url && ! $loop->last)
                <li class="breadcrumb__menu gap-2">
                    <x-icons.icon-chevron-rigth class="h-4 w-4"/>
                    <a href="{{ $breadcrumb->url }}">
                        {{ $breadcrumb->title }}
                    </a>
                </li>
            @else
                <li aria-current="page">
                    <div class="flex items-center text-xs font-medium gap-2">
                        <x-icons.icon-chevron-rigth class="h-4 w-4"/>
                        <span class="text-gray-300"> {{ $breadcrumb->title }}</span>
                    </div>
                </li>
            @endif
        @endforeach
    </ol>
</div>
