<div class="sidebar">
    <ul class="sidebar__section">
        <li class="sidebar__link">
            <a href="#" class="">
                <i class="fa-solid fa-house"></i>
                <span>Dashboard</span>
            </a>
        </li>
    </ul>
    <ul class="sidebar__section">
        <li class="sidebar__link @if(request()->routeIs('admin.users.index')) sidebar__link__active @endif">
            <a href="{{ route('admin.users.index') }}">
                <i class="fa-solid fa-user"></i>
                <span>{{  __('nav.users') }}</span>
            </a>
        </li>
        <li class="sidebar__link @if(request()->routeIs('admin.roles.index')) sidebar__link__active @endif">
            <a href="{{ route('admin.roles.index') }}">
                <i class="fa-solid fa-user-gear"></i>
                <span>{{  __('nav.roles') }}</span>
            </a>
        </li>
        <li class="sidebar__link @if(request()->routeIs('admin.logs.index')) sidebar__link__active @endif">
            <a href="{{ route('admin.logs.index') }}">
                <i class="fa-solid fa-box-archive"></i>
                <span>{{  __('nav.logs') }}</span>
            </a>
        </li>
    </ul>
    <ul class="sidebar__section">
        <li class="sidebar__link @if(request()->routeIs('admin.book.index')) sidebar__link__active @endif">
            <a href="{{ route('admin.book.index') }}">
                <i class="fa-solid fa-book-bookmark"></i>
                <span>{{  __('nav.books') }}</span>
            </a>
        </li>
        <li class="sidebar__link @if(request()->routeIs('admin.chapters.index')) sidebar__link__active @endif">
            <a href="{{ route('admin.chapters.index') }}">
                <i class="fa-solid fa-book-open"></i>
                <span>{{  __('nav.chapters') }}</span>
            </a>
        </li>
        <li class="sidebar__link @if(request()->routeIs('admin.pages.index')) sidebar__link__active @endif">
            <a href="{{ route('admin.pages.index') }}">
                <i class="fa-sharp fa-solid fa-file-circle-check"></i>
                <span>{{  __('nav.pages') }}</span>
            </a>
        </li>
    </ul>
</div>
