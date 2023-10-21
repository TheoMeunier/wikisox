<div>
    <div class="flex justify-end pb-3">
        <x-links.link-button-primary href="{{ route('admin.logs.export') }}" class="btn btn__primary">
            {{ __('button.action.export') }}
        </x-links.link-button-primary>
    </div>

    <table>
        <thead>
        <tr>
            <th>{{ __('table.id') }}</th>
            <th>{{ __('table.username') }}</th>
            <th>{{ __('table.action') }}</th>
            <th>{{ __('table.subject_name') }}</th>
            <th>{{ __('table.createdAt') }}</th>
            <th>{{ __('table.updatedAt') }}</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($logs as $log)
            <tr>
                <td class="py-4">
                    <p class="text-gray-900 whitespace-no-wrap">
                        {{ $log->id }}
                    </p>
                </td>
                <td>
                    <p class="text-gray-900 whitespace-no-wrap">
                        {{ $log->causer->name ?? '' }}
                    </p>
                </td>
                <td>
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
                <td>
                    <p class="text-gray-900 whitespace-no-wrap">
                        {{ $log->subject->name ?? '' }}
                    </p>
                </td>
                <td>
                    <p class="text-gray-900 whitespace-no-wrap">
                        {{ $log->created_at->format('d/m/Y') }}
                    </p>
                </td>
                <td>
                    <p class="text-gray-900 whitespace-no-wrap">
                        {{ $log->updated_at->format('d/m/Y')  }}
                    </p>
                </td>
                <td>
                    @if($log->event === 'deleted' && $log->subject->trashed())
                        <button
                            type="button"
                            class="table-action text-primary"
                            wire:click.prevent="$emit('openModal', 'admin.logs.modals.admin-logs-modals-restore-livewire', {{ json_encode(['log' => $log]) }})"
                        >
                            <x-icons.icon-restore class="w-6 h-6"/>
                            {{ __('button.action.restore') }}
                        </button>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="pagination">
        {{ $logs->links('components.modules.pagination') }}
    </div>
</div>
