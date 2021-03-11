<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Publications') }} {{ $publication->id }}
        </h2>
        <div>
            <a href="{{ route('publication.index') }}" class="text-gray-700 underline">
                {{ __('Back') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <!-- TODO: Create just one template for show and user-show -->
                    <div class="pb-4">
                        <h3 class="font-bold text-lg">{{ $publication->title }} </h3>
                        <p class="py-1 text-justify">{{ $publication->content }}</p>
                        <div class="text-sm font-semibold text-indigo-700">
                            Author: <b>{{ $publication->user->name}}</b> |
                            Created: <b>{{ $publication->created_at->diffForHumans()}}</b> | Updated: <b>{{ $publication->created_at->diffForHumans()}}</b> <br>
                        </div>
                    </div>
                    <hr>
                    <div>
                        <h3 class="font-bold text-lg">Comments {{ $publication->comments->where('comment_state_id', 2)->count()}}</h3>
                        <div class="grid grid-cols-1 lg:grid-cols-2 divide-y">
                            @foreach($comments as $comment)
                            <!-- Set a pagination with Livewire -->
                            <div class="px-4 py-2">
                                <p class="py-1 text-justify">{{$comment->content}}</p>
                                <div class="text-sm font-semibold text-indigo-700">
                                    <b>{{$comment->user->name}}</b> - {{$comment->created_at->diffForHumans()}}
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @if(!$has_commented)
                    <div>
                        <h3 class="font-bold text-lg">Add comment</h3>
                        <form action="{{route('publication.comment.store', $publication->id)}}" method="POST">
                            @csrf
                            <div>
                                <x-jet-label for="content" value="{{ __('Content') }}" />
                                <textarea id="content" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" type="text" name="content" required></textarea>
                            </div>
                            <x-jet-validation-errors class="mb-4" />
                            <div class="flex items-center justify-end mt-4">
                                <span class="text-sm">
                                    Note: The comment should be approved by the author.
                                </span>
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