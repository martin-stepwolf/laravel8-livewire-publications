<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Publication') . ' ' . $publication->id }}
        </h2>
        <div>
            <a href="{{ route('user.publication.index', ['user' => Auth::user()->id]) }}">
                {{ __('Back') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <h3 class="font-bold">{{ $publication->title }}</h3>
                <p>{{ $publication->content }}</p>
                <p>Created {{ $publication->created_at->diffForHumans()}} |
                    Updated {{ $publication->created_at->diffForHumans()}}</p>
            </div>
            <hr>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <h3 class="font-bold">Comments</h3>
                <table>
                    <thead>
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
                        @foreach($publication->comments as $comment)
                        <tr>
                            <td>{{ $comment->user->name }}</td>
                            <td> {{$comment->content}}</td>
                            <td> {{ $comment->comment_state->title}}</td>
                            <td>{{ $comment->updated_at->diffForHumans() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>