<nav class="admin__navbar">
    <div class="admin__navbar__start">
        <div class="shrink-0 flex items-center ">
            <a href="{{ route('dashboard') }}">
                <x-icons.application-logo class="block h-10 w-auto fill-current text-gray-600" />
            </a>
            <p class="h3 ml-3">IsoxBook</p>
        </div>
    </div>
    <div class="admin__navbar__end">
        <ul>
            <li>{{ auth()->user()->name }}</li>
        </ul>
        <ul class="admin__navbar__item">
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                this.closest('form').submit();">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                </a>
            </form>
        </ul>
    </div>
</nav>
