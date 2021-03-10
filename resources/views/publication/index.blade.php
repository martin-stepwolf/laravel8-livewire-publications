<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Publications') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @foreach($publications as $publication)
                <div>
                    <h3 class="font-bold">{{ $publication->id }}.- {{ $publication->title }} </h3>
                    <p>{{ $publication->excerpt }}</p>
                    <div>
                        {{$publication->publication_state_id}}
                        Author: <b>{{ $publication->user->name}}</b> |
                        Comments: {{ $publication->comments->where('comment_state_id', 2)->count()}} |
                        <a href="{{ route('publication.show', $publication->id) }}">See more</a>
                    </div>
                </div>
                @endforeach
                @if($publications === [])
                <div>
                    <td class="border px-4 py-2" colspan="5">There are not publications</td>
                </div>
                @endif
                {{ $publications->links() }}
            </div>
        </div>
    </div>
</x-app-layout>