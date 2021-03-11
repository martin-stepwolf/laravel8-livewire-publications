<div class="border-2 py-2">
    <h3 class="font-bold text-lg text-center">{{$title}} {{ $comments->total()}}</h3>
    <div class="grid grid-cols-1 lg:grid-cols-2 divide-y">
        @forelse($comments as $comment)
        <div class="px-4 py-2">
            <p class="py-1 text-justify @if(Auth::id() == $comment->user_id) font-bold @endif">{{$comment->content}}</p>
            <div class="text-sm font-semibold text-indigo-700">
                <b>{{$comment->user->name}}</b> - {{$comment->created_at->diffForHumans()}}
            </div>
        </div>
        @empty
        <div class="px-4 py-2">endif are not comments.</div>
        @endforelse
    </div>
    <div class="mx-4">
        {{ $comments->links() }}
    </div>
</div>