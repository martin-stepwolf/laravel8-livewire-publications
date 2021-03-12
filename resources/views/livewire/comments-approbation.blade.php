<div>
    @if (session()->has('confirmation'))
    <div class="text-sm text-blue-600">
        {{ session('confirmation') }}
    </div>
    @endif
    <table class="table table-auto border-2 bg-gray-100 w-full">
        <thead class="font-bold">
            <tr>
                <td class="border px-4 py-2">
                    Comment
                </td>
                <td class="border px-4 py-2">
                    Actions
                </td>
            </tr>
        </thead>
        <tbody>
            @forelse($comments as $comment)
            <tr>
                <td class="border px-4 py-2">
                    <p class="py-1 text-justify">
                        {{ $comment->content }}
                    </p>
                    <div class="text-sm font-semibold text-indigo-700">
                        {{ $comment->user->name }} - {{ $comment->created_at->diffForHumans() }}
                    </div>
                </td>
                <td>
                    <x-primary-button class="mb-1" onclick="confirm('Are you sure to approve this comment from {{ $comment->user->name }}?') || event.stopImmediatePropagation()" wire:click="approve({{ $comment->id }})">
                        Approve
                    </x-primary-button>
                    <x-jet-button onclick="confirm('Are you sure to reject this comment from {{ $comment->user->name }}?') || event.stopImmediatePropagation()" wire:click="reject({{ $comment->id }})">
                        Reject
                    </x-jet-button>
                </td>
            </tr>
            @empty
            <tr>
                <td class="2 text-center text-red-500" colspan="2">There are not comments</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    {{ $comments->links() }}
</div>