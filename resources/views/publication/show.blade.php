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
                        Author: <b>{{ $publication->user->name}}</b> | Comments: <b>{{ $publication->comments->where('comment_state_id', 2)->count()}}</b>
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
                <hr>
                @if(!$has_commented)
                <div>
                    <h3 class="font-bold">Add a comentary</h3>
                    <p>Note: All the commentary should be approved by the author.</p>
                    <form action="{{route('publication.comment.store', $publication->id)}}" method="POST">
                        @csrf
                        <div>
                            <label>Content*</label>
                            <textarea name="content" rows="1" required></textarea>
                        </div>
                        <div>
                            <input type="submit" value="Send">
                        </div>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>