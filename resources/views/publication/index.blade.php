<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Publications') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg grid grid-cols-1 lg:grid-cols-2">
                @foreach($publications as $publication)
                <!-- Create a template for his kind of containers -->
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <h3 class="font-bold">{{ $publication->id }}.- {{ $publication->title }} </h3>
                    <p class="py-1 text-justify">{{ $publication->excerpt }}</p>
                    <span class="text-sm font-semibold text-indigo-700">
                        {{$publication->publication_state_id}}
                        Author: <b>{{ $publication->user->name}}</b> |
                        Comments: {{ $publication->comments->where('comment_state_id', 2)->count()}}
                    </span>
                    <a href="{{ route('publication.show', $publication->id) }}" class="ml-4 text-gray-700 underline">
                        See more
                    </a>
                </div>
                @endforeach
                @if($publications === [])
                <div class="border px-4 py-2">There are not publications</div>
                @endif
            </div>
            {{ $publications->links() }}
        </div>
    </div>
</x-app-layout>