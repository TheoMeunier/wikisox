<div>
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
                        <x-links.link-icon href="{{ route('admin.roles.edit', ['id' => $role->id ]) }}"
                                           class="text-indigo-500">
                            <x-icons.icon-edit class="h-6 w-6"/>
                        </x-links.link-icon>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>