<x-app-layout>
    <section class="container">
        <div class="h-50 py-9 flex items-center">
            <div>
                <form id="form__avatar" class="profil-header__avatar" enctype="multipart/form-data" method="post">
                    <div id="wrapper__avatar_img" class="flex w-full h-full">
                        @if(auth()->user()->avatar)
                            <img src="{{ Storage::url(auth()->user()->avatar ?? '') }}" class="object-contain" alt="">
                        @else
                            <x-icons.icon-user class="text-white p-5 profil-header__svg"/>
                        @endif
                    </div>
                    <div class="profil-header__upload">
                        <i class="fa-solid fa-arrow-up-from-bracket"></i>
                    </div>
                    <input type="file" name="avatar">
                </form>
            </div>
            <div class="ml-4">
                <h2 class="font-semibold">{{ auth()->user()->name }}</h2>
                <p class="text-muted mt-2">utilisateur depuis : {{ auth()->user()->created_at->diffForHumans(null, true) }}</p>
            </div>
        </div>
        <div class="text-gray-800">
            <div class="border-b border-gray-200">
                <ul class="flex gap-2" id="tab_profile" role="profile">
                    <li role="profile">
                        <a href="{{ route('profile.index') }}" class="flex items-center gap-3 hover:text-indigo-600 hover:border-indigo-500 hover:border-b-2 rounded-t-lg p-4 @if(request()->routeIs('profile.index')) text-indigo-600 border-indigo-500 border-b-2 @endif" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile_index">
                            <x-icons.icon-user />
                            {{ __('tab.profile.index') }}
                        </a>
                    </li>
                    <li role="edit">
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 hover:text-indigo-600 hover:border-indigo-500 hover:border-b-2 rounded-t-lg p-4 @if(request()->routeIs('profile.edit')) text-indigo-600 border-indigo-500 border-b-2 @endif" id="profile-edit-tab" data-tabs-target="#edit" type="button" role="tab" aria-controls="profile_edit">
                            <x-icons.icon-edit class="w-6 h-6"/>
                            {{ __('tab.profile.edit') }}
                        </a>
                    </li>
                    <li role="logs">
                        <a href="{{ route('profile.actions') }}" class="flex items-center gap-3 hover:text-indigo-600 hover:border-indigo-500 hover:border-b-2 rounded-t-lg p-4 @if(request()->routeIs('profile.actions')) text-indigo-600 border-indigo-500 border-b-2 @endif" id="profile-actions-tab"  data-tabs-target="#logs" type="button" role="tab" aria-controls="profile_logs">
                            <x-icons.icon-logs />
                            {{ __('tab.profile.action') }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <section class="container">
        {{ $slot }}
    </section>
</x-app-layout>
