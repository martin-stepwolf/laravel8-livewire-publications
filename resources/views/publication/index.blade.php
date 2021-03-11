<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Publications') }}
        </h2>
    </x-slot>

    <div class="pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end">
                <form class="flex my-2 md:w-2/3 lg:w-1/2">
                    <x-jet-input name="q" class="block mt-1 w-full" type="text" value="{{ $q }}" placeholder="Search by title or content"/>
                    <x-jet-button class="ml-4">
                        Search
                    </x-jet-button>
                </form>
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg grid grid-cols-1 lg:grid-cols-2">
                @forelse($publications as $publication)
                <!-- Create a template for his kind of containers -->
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <h3 class="font-bold">{{ $publication->id }}.- {{ $publication->title }} </h3>
                    <p class="py-1 text-justify">{{ $publication->excerpt }}</p>
                    <div class="text-sm font-semibold text-indigo-700">
                        {{$publication->publication_state_id}}
                        <b>{{ $publication->user->name}} - {{ $publication->created_at->diffForHumans()}}</b> |
                        Comments: {{ $publication->comments->where('comment_state_id', 2)->count()}}
                    </div>
                    <a href="{{ route('publication.show', $publication->id) }}" class="text-gray-700 underline">
                        See more
                    </a>
                </div>
                @empty
                <div class="border px-4 py-2 text-center text-red-500 lg:col-span-2">There are not publications</div>
                @endforelse
            </div>
            <!-- BUG: Add the pagination in the links -->
            {{ $publications->links() }}
        </div>
    </div>
</x-app-layout>