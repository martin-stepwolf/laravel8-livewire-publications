<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Publications') }} {{ $publication->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <h3 class="font-bold">{{ $publication->title }} </h3>
                    <p>{{ $publication->content }}</p>
                    <div>
                        Created <b>{{ $publication->created_at->diffForHumans()}}</b> | Updated <b>{{ $publication->created_at->diffForHumans()}}</b> <br>
                        Author: <b>{{ $publication->user->name}}</b> | Comments: <b>{{ $publication->comments->where('comment_state_id', 2)->count()}}</b>
                    </div>
                    <hr>
                    <h3 class="font-bold">Comments</h3>
                    <div class="grid grid-cols-1 lg:grid-cols-2">
                        @foreach($comments as $comment)
                        <div>
                            User: <b>{{$comment->user->name}}</b><br>
                            Created: <b>{{$comment->created_at->diffForHumans()}}</b></br>
                            Content: {{$comment->content}}
                        </div>
                        @endforeach
                    </div>
                    <hr>
                    @if(!$has_commented)
                    <div>
                        <div class="mb-4 text-gray-600">
                            Add comment <br>
                            <span class="tx-sm">
                                Note: All the commentary should be approved by the author.
                            </span>
                        </div>
                        <form action="{{route('publication.comment.store', $publication->id)}}" method="POST">
                            @csrf


                            <div class="mt-4">
                                <x-jet-label for="content" value="{{ __('Content') }}" />
                                <textarea id="content" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" type="text" name="content" required></textarea>
                            </div>
                            <x-jet-validation-errors class="mb-4" />
                            <div class="flex items-center justify-end mt-4">
                                <x-jet-button class="ml-4">
                                    Send
                                </x-jet-button>
                            </div>
                        </form>
                    </div>
                    @endif
                </div>
                <hr>
            </div>
        </div>
    </div>
</x-app-layout>