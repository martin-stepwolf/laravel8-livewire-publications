<div>
    <table>
        <thead>
            <tr>
                <td class="border px-4 py-2">
                    Id
                </td>
                <td class="border px-4 py-2">
                    Title / Abstract
                </td>
                <td class="border px-4 py-2">
                    Comments
                </td>
                <td class="border px-4 py-2">
                    Updated at
                </td>
                <td class="border px-4 py-2" colspan="2">
                    Actions
                </td>
            </tr>
        </thead>
        <tbody>
            @foreach($publications as $publication)
            <tr>
                <td>{{ $publication->id }}</td>
                <td>
                    <b>{{ $publication->title }}</b> <br>
                    {{ $publication->excerpt }}
                </td>
                <td>
                    Waiting: {{ $publication->comments->where('comment_state_id', 1)->count()}} <br>
                    Approved: {{ $publication->comments->where('comment_state_id', 1)->count()}} <br>
                    Rejected: {{ $publication->comments->where('comment_state_id', 1)->count()}}
                </td>
                <td>{{ $publication->updated_at->diffForHumans() }}</td>
                <td class="px-4 py-2">
                    <button onclick="confirm('Are you sure to delete this publication {{ $publication->id }}?') || event.stopImmediatePropagation()" wire:click="destroy({{ $publication->id }})">
                        Delete
                    </button>
                    <a href="{{ route('publication.show', $publication->id) }}">
                        Look
                    </a>
                </td>
                <td class="px-4 py-2">
                    <a wire:click="edit({{ $publication->id }})">
                        Edit
                    </a>
                </td>
            </tr>
            @endforeach
            @if($publications === [])
            <tr>
                <td class="border px-4 py-2" colspan="5">There are not publications</td>
            </tr>
            @endif
        </tbody>
    </table>
    {{ $publications->links() }}
</div>