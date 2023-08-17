<div>
    <table class="table">
        <tbody>
        @foreach ($logs as $log)
            <tr>
                <td class="py-4">{{ $log->id }}</td>
                <td>{{ $log->causer->name ?? '' }}</td>
                <td>
                    @if($log->event === 'created')
                        <span class="tag tag-success">
                                {{ __('js.table.action.create') }}
                            </span>
                    @elseif($log->event === 'updated')
                        <span class="tag tag-warning">
                                {{ __('js.table.action.update') }}
                            </span>
                    @elseif($log->event === 'deleted')
                        <span class="tag tag-danger">
                                {{ __('js.table.action.delete') }}
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
        {{ $logs->links('components.modules.pagination') }}
    </div>
</div>
