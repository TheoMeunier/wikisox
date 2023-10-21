<x-admin.admin-app-layout>
    <h1>
        <span class="text-indigo-500 mr-3">
            <x-icons.icon-diagrams class="w-8 h-8"/>
        </span>
        {{ __('title.dashboard') }}
    </h1>

    <section class="grid grid-cols-4 gap-4 my-6">
        <div class="card card__body flex items-center text-indigo-500">
            <div class="w-1/4">
               <x-icons.icon-user-group class="w-10 h-10"/>
            </div>
            <div>
                <p class="h4">{{ __('title.users') }}</p>
                <p class="text-gray-400">{{ $users }}</p>
            </div>
        </div>
        <div class="card card__body flex items-center text-cyan-500">
            <div class="w-1/4">
                <x-icons.icon-books class="w-9 h-9"/>
            </div>
            <div>
                <p class="h4">{{ __('title.books') }}</p>
                <p class="text-gray-400">{{ $books }}</p>
            </div>
        </div>
        <div class="card card__body flex items-center text-emerald-500">
            <div class="w-1/4">
                <x-icons.icon-folders class="w-9 h-9"/>
            </div>
            <div>
                <p class="h4">{{ __('title.chapters') }}</p>
                <p class="text-gray-400">{{ $chapters }}</p>
            </div>
        </div>
        <div class="card card__body flex items-center text-red-500">
            <div class="w-1/4">
                <x-icons.icon-files class="w-9 h-9"/>
            </div>
            <div>
                <p class="h4">{{ __('title.pages') }}</p>
                <p class="text-gray-400">{{ $pages }}</p>
            </div>
        </div>
    </section>

    <section class="card card__body">
        <h2>
            <span class="text-indigo-500 text-3xl"><i class="fa-solid fa-box-archive"></i></span>
            {{ __('title.logs') }}
        </h2>

        <table class="table mt-3">
            <tbody>
            @foreach ($logs as $log)
                <tr>
                    <td class="py-3">{{ $log->id }}</td>
                    <td class="py-3">{{ $log->causer->name ?? 'Server' }}</td>
                    <td class="py-3">
                        @if($log->description === 'created')
                            <span class="tag tag-success">
                            {{ __('tag.created') }}
                        </span>
                        @elseif($log->description === 'updated')
                            <span class="tag tag-warning">
                        {{ __('tag.updated') }}
                        </span>
                        @elseif($log->description === 'deleted')
                            <span class="tag tag-danger">
                            {{ __('tag.deleted') }}
                        </span>
                        @elseif($log->description === 'restored')
                            <span class="tag tag-primary">
                            {{ __('tag.restored') }}
                        </span>
                        @endif
                    </td>
                    <td class="py-3">{{ $log->subject->name ?? 'Server' }}</td>
                    <td class="py-3">{{ $log->created_at->format('d/m/Y') }}</td>
                    <td class="py-3">{{ $log->updated_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>
</x-admin.admin-app-layout>



