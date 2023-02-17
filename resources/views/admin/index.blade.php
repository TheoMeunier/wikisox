<x-admin.admin-app-layout>
    <h1>{{ __('title.dashboard') }}</h1>

    <section class="grid grid-cols-4 gap-4 my-6">
        <div class="card card__body flex items-center text-indigo-500">
            <div class="w-1/4">
                <i class="fa-solid fa-user h2"></i>
            </div>
            <div>
                <p class="h4">{{ __('title.users') }}</p>
                <p class="text-gray-400">{{ $users }}</p>
            </div>
        </div>
        <div class="card card__body flex items-center text-cyan-500">
            <div class="w-1/4">
                <i class="fa-solid fa-book-bookmark h2"></i>
            </div>
            <div>
                <p class="h4">{{ __('title.books') }}</p>
                <p class="text-gray-400">{{ $books }}</p>
            </div>
        </div>
        <div class="card card__body flex items-center text-emerald-500">
            <div class="w-1/4">
                <i class="fa-solid fa-book-open h2"></i>
            </div>
            <div>
                <p class="h4">{{ __('title.chapters') }}</p>
                <p class="text-gray-400">{{ $chapters }}</p>
            </div>
        </div>
        <div class="card card__body flex items-center text-red-500">
            <div class="w-1/4">
                <i class="fa-sharp fa-solid fa-file-circle-check h2"></i>
            </div>
            <div>
                <p class="h4">{{ __('title.pages') }}</p>
                <p class="text-gray-400">{{ $pages }}</p>
            </div>
        </div>
    </section>

    <section class="card card__body">
        <h2>{{ __('title.logs') }}</h2>

        <table class="table">
            <tbody>
            @foreach ($logs as $log)
                <tr>
                    <td>{{ $log->id }}</td>
                    <td>{{ $log->causer->name ?? 'Server' }}</td>
                    <td>
                        @if($log->event === 'created')
                            <p class="whitespace-no-wrap">
                                <span
                                    class="relative inline-block px-3 py-1 font-semibold leading-tight text-green-900">
                                    <span class="absolute inset-0 rounded-full bg-green-200 opacity-50"></span>
                                        <span class="relative">{{ __('js.table.action.create') }}</span>
                                </span>
                            </p>
                        @elseif($log->event === 'updated')
                            <p class="whitespace-no-wrap">
                                <span
                                    class="relative inline-block px-3 py-1 font-semibold leading-tight text-orange-900">
                                    <span class="absolute inset-0 rounded-full bg-orange-200 opacity-50"></span>
                                        <span class="relative">{{ __('js.table.action.update') }}</span>
                                </span>
                            </p>
                        @elseif($log->event === 'deleted')
                            <p class="whitespace-no-wrap">
                                <span
                                    class="relative inline-block px-3 py-1 font-semibold leading-tight text-red-900">
                                    <span class="absolute inset-0 rounded-full bg-red-200 opacity-50"></span>
                                        <span class="relative">{{ __('js.table.action.delete') }}</span>
                                </span>
                            </p>
                        @endif
                    </td>
                    <td>{{ $log->subject->name ?? 'Server' }}</td>
                    <td>{{ $log->created_at->format('d/m/Y') }}</td>
                    <td>{{ $log->updated_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>
</x-admin.admin-app-layout>



