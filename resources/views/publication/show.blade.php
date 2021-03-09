<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Publication') . ' ' . $publication->id }}
        </h2>
        <div>
            <a href="{{ route('publication.index') }}">
                {{ __('Back') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <h3>{{ $publication->title }}</h3>
                <p>{{ $publication->content }}</p>
                <p>Created {{ $publication->created_at->diffForHumans()}}</p>
                <p>Updated {{ $publication->created_at->diffForHumans()}}</p>
            </div>
        </div>
    </div>
</x-app-layout>