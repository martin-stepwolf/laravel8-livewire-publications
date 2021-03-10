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
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <h3 class="font-bold">{{ $publication->id }}.- {{ $publication->title }} </h3>
                    <p>{{ $publication->excerpt }}</p>
                    <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                        {{$publication->publication_state_id}}
                        Author: <b>{{ $publication->user->name}}</b> |
                        Comments: {{ $publication->comments->where('comment_state_id', 2)->count()}}
                    </div>
                    <a href="{{ route('publication.show', $publication->id) }}">
                        <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                            <div>Look more</div>

                            <div class="ml-1 text-indigo-500">
                                <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
                @if($publications === [])
                <div>
                    <td class="border px-4 py-2" colspan="5">There are not publications</td>
                </div>
                @endif
            </div>
            {{ $publications->links() }}
        </div>
    </div>
</x-app-layout>