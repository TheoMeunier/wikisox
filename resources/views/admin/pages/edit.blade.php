<x-admin.admin-app-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <h1>{{ __('title.page.edit') }}</h1>

            <form action="{{ route('admin.pages.update', ['slug' => $page->slug]) }}" method="POST">
                @csrf
                <div>
                    <div >
                        <x-label for="name" :value="__('input.label.name')"/>
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $page->name}}"
                                 required autofocus/>
                    </div>
                    <div class="mt-10">
                        <x-label for="description" :value="__('input.label.description')"/>
                        <x-forms.mde name="content" value="{!!  $page->content  !!}"></x-forms.mde>
                    </div>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-button class="ml-3">
                        {{ __('button.action.edit') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-admin.admin-app-layout>
