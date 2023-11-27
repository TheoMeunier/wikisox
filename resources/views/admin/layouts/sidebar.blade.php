<aside id="logo-sidebar" class="dashboard-sidebar">
    <div class="dashboard-sidebar__wrapper">
        <x-modules.sidebar.sidebar-menu>
            <x-modules.sidebar.sidebar-link href="{{ route('admin.index')}}" :active="request()->routeIs('admin.index')">
                <x-icons.icon-diagrams />
                {{  __('nav.dashboard') }}
            </x-modules.sidebar.sidebar-link>
        </x-modules.sidebar.sidebar-menu>
        <x-modules.sidebar.sidebar-menu>
            <li class="sidebar-menu-title">Administration</li>
            <x-modules.sidebar.sidebar-link href="{{ route('admin.users.index') }}" :active="request()->routeIs('admin.users.*')">
                <x-icons.icon-user-group/>
                {{  __('nav.users') }}
            </x-modules.sidebar.sidebar-link>
            <x-modules.sidebar.sidebar-link href="{{ route('admin.roles.index') }}" :active="request()->routeIs('admin.roles.*')">
                <x-icons.icon-roles/>
                {{  __('nav.roles') }}
            </x-modules.sidebar.sidebar-link>
            <x-modules.sidebar.sidebar-link href="{{ route('admin.logs.index') }}" :active="request()->routeIs('admin.logs.*')">
                <x-icons.icon-logs/>
                {{  __('nav.logs') }}
            </x-modules.sidebar.sidebar-link>
        </x-modules.sidebar.sidebar-menu>
        <x-modules.sidebar.sidebar-menu>
            <li class="sidebar-menu-title">Properties</li>
            <x-modules.sidebar.sidebar-link href="{{ route('admin.book.index') }}" :active="request()->routeIs('admin.book.*')">
                <x-icons.icon-books />
                {{  __('nav.books') }}
            </x-modules.sidebar.sidebar-link>
            <x-modules.sidebar.sidebar-link href="{{ route('admin.chapters.index') }}" :active="request()->routeIs('admin.chapters.*')">
                <x-icons.icon-folders />
                {{  __('nav.chapters') }}
            </x-modules.sidebar.sidebar-link>
            <x-modules.sidebar.sidebar-link href="{{ route('admin.pages.index') }}" :active="request()->routeIs('admin.pages.*')">
                <x-icons.icon-files/>
                {{  __('nav.pages') }}
            </x-modules.sidebar.sidebar-link>
        </x-modules.sidebar.sidebar-menu>
    </div>
</aside>
