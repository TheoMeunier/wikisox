<x-admin.admin-app-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200 mx-5">
            <div class="justify__between">
                <h1>{{ __('title.roles') }}</h1>
                <a href="{{ route('admin.roles.create') }}" class="btn btn__primary">
                    <i class="fa-solid fa-plus mr-2"></i>
                    {{ __('button.action.create') }}
                </a>
            </div>

            <div class="mt-8">
                <table>
                    <thead>
                    <tr>
                        <th>{{ __('table.id') }}</th>
                        <th>{{ __('table.name') }}</th>
                        <th>{{ __('table.createdAt') }}</th>
                        <th>{{ __('table.updatedAt') }}</th>
                        <th>{{ __('table.action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td>
                                <p class="text-gray-900 whitespace-no-wrap">
                                    {{ $role->id }}
                                </p>
                            </td>
                            <td>
                                <p class="text-gray-900 whitespace-no-wrap">
                                    {{ $role->name }}
                                </p>
                            </td>
                            <td>
                                <p class="text-gray-900 whitespace-no-wrap">
                                    {{ $role->created_at->format('d/m/Y') }}
                                </p>
                            </td>
                            <td>
                                <p class="text-gray-900 whitespace-no-wrap">
                                    {{ $role->updated_at->format('d/m/Y')  }}
                                </p>
                            </td>
                            <td>
                                @if($role->id !== 1)
                                    <p class="flex align-center">
                                        <a href="{{ route('admin.roles.edit', ['id' => $role->id]) }}"
                                           class="text-gray-900 whitespace-no-wrap">
                                            <i class="fa-solid fa-pen-to-square mr-2"></i>
                                        </a>
                                    </p>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin.admin-app-layout>
