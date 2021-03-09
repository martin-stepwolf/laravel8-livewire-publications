<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Publications') }} {{ $publication->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div>
                    <h3 class="font-bold">{{ $publication->title }} </h3>
                    <p>{{ $publication->content }}</p>
                    <div>
                        Created <b>{{ $publication->created_at->diffForHumans()}}</b> | Updated <b>{{ $publication->created_at->diffForHumans()}}</b> <br>
                        Author: <b>{{ $publication->user->name}}</b> | Comments: <b>{{ $publication->comments->where('comment_state_id', 1)->count()}}</b>
                    </div>
                </div>
                <hr>
                <div>
                    <h3 class="font-bold">Comments</h3>
                    @foreach($comments as $comment)
                    <div>
                        User: <b>{{$comment->user->name}}</b><br>
                        Created: <b>{{$comment->created_at->diffForHumans()}}</b></br>
                        Content: {{$comment->content}}
                    </div>
                    <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>