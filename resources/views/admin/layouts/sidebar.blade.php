<aside id="logo-sidebar" class="dashboard-sidebar">
    <div class="dashboard-sidebar__wrapper">
        <x-modules.sidebar.sidebar-menu>
            <x-modules.sidebar.sidebar-link href="{{ route('admin.index')}}">
                <x-icons.icon-diagrams />
                {{  __('nav.dashboard') }}
            </x-modules.sidebar.sidebar-link>
        </x-modules.sidebar.sidebar-menu>
        <x-modules.sidebar.sidebar-menu>
            <li class="sidebar-menu-title">Administration</li>
            <x-modules.sidebar.sidebar-link href="{{ route('admin.users.index') }}">
                <x-icons.icon-user-group/>
                {{  __('nav.users') }}
            </x-modules.sidebar.sidebar-link>
            <x-modules.sidebar.sidebar-link href="{{ route('admin.roles.index') }}">
                <x-icons.icon-roles/>
                {{  __('nav.roles') }}
            </x-modules.sidebar.sidebar-link>
            <x-modules.sidebar.sidebar-link href="{{ route('admin.logs.index') }}">
                <x-icons.icon-logs/>
                {{  __('nav.logs') }}
            </x-modules.sidebar.sidebar-link>
        </x-modules.sidebar.sidebar-menu>
        <x-modules.sidebar.sidebar-menu>
            <li class="sidebar-menu-title">Properties</li>
            <x-modules.sidebar.sidebar-link href="{{ route('admin.book.index') }}">
                <x-icons.icon-books />
                {{  __('nav.books') }}
            </x-modules.sidebar.sidebar-link>
            <x-modules.sidebar.sidebar-link href="{{ route('admin.chapters.index') }}">
                <x-icons.icon-folders />
                {{  __('nav.chapters') }}
            </x-modules.sidebar.sidebar-link>
            <x-modules.sidebar.sidebar-link href="{{ route('admin.pages.index') }}">
                <x-icons.icon-files/>
                {{  __('nav.pages') }}
            </x-modules.sidebar.sidebar-link>
            <x-modules.sidebar.sidebar-link href="{{ route('admin.image') }}">
                <x-icons.icon-user-group/>
                {{  __('nav.pages') }}
            </x-modules.sidebar.sidebar-link>
        </x-modules.sidebar.sidebar-menu>
    </div>
</aside>
