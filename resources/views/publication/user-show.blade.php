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
                    <div class="bg-gray-100 mt-4 mb-2">
                        @livewire('publication-comments', [
                        'title' => 'Comments approved',
                        'publication_id' => $publication->id,
                        'comment_state_id' => 2
                        ])
                    </div>
                    <div class="bg-red-100  mb-2">
                        @livewire('publication-comments', [
                        'title' => 'Comments rejected',
                        'publication_id' => $publication->id,
                        'comment_state_id' => 3
                        ])
                    </div>
                    <div>
                        <h3 class="font-bold text-lg">New comments on hold</h3>
                        <div>
                            @livewire('comments-component', [
                            'publication_id' => $publication->id,])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>