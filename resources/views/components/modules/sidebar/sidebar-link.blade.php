@props(['href'])

<li>
    <a href="{{ $href }}" class="sidebar-link">
        {{ $slot }}
    </a>
</li>
