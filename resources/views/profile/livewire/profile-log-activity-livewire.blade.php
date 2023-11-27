<div>
    <table class="table">
        <tbody>
        @foreach ($logs as $log)
            <tr>
                <td class="py-4">{{ $log->id }}</td>
                <td>{{ $log->causer->name ?? '' }}</td>
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
                <td>{{ $log->subject->name ?? '' }}</td>
                <td>{{ $log->created_at->format('d/m/Y') }}</td>
                <td>{{ $log->updated_at->format('d/m/Y') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="pagination">
        {{ $logs->links('livewire.components.pagination') }}
    </div>
</div>
