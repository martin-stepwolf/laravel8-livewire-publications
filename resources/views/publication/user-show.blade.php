<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Publication') . ' ' . $publication->id }}
        </h2>
        <div>
            <a href="{{ route('user.publication.index', ['user' => Auth::user()->id]) }}" class="text-gray-700 underline">
                {{ __('Back') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="pb-4">
                        <h3 class="font-bold text-lg">{{ $publication->title }}</h3>
                        <p class="py-1 text-justify">{{ $publication->content }}</p>
                        <div class="text-sm font-semibold text-indigo-700">
                            Created {{ $publication->created_at->diffForHumans()}} |
                            Updated {{ $publication->created_at->diffForHumans()}}
                        </div>
                    </div>
                    <hr>
                    <h3 class="font-bold text-lg">Comments</h3>
                    <table class="table table-auto border-2 bg-gray-100">
                        <thead class="font-bold">
                            <tr>
                                <td class="border px-4 py-2">
                                    User
                                </td>
                                <td class="border px-4 py-2">
                                    Comment
                                </td>
                                <td class="border px-4 py-2">
                                    State
                                </td>
                                <td class="border px-4 py-2">
                                    Created at
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Show just the comments on hold and set the possibility to approve or reject -->
                            @foreach($publication->comments as $comment)
                            <tr>
                                <td class="border px-4 py-2">{{ $comment->user->name }}</td>
                                <td class="border px-4 py-2 text-justify"> {{$comment->content}}</td>
                                <td class="border px-4 py-2"> {{ $comment->comment_state->title}}</td>
                                <td class="border px-4 py-2">{{ $comment->updated_at->diffForHumans() }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>