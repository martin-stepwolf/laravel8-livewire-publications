<?php
/** @var \App\ViewModels\Publication\ShowPublicationViewModel $vM */
?>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Publications') }} {{ $vM->publication->getKey() }}
        </h2>
        <div>
            <a href="{{ route('publication.index') }}" class="text-gray-700 underline">
                {{ __('Back') }}
            </a>
        </div>
    </x-slot>

<!-- TODO: Create just one view of show and user-show -->

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <!-- TODO: Create just one template for show and user-show -->
                    <div class="pb-4">
                        <h3 class="font-bold text-lg">{{ $vM->publication->title }} </h3>
                        <p class="py-1 text-justify">{{ $vM->publication->content }}</p>
                        <div class="text-sm font-semibold text-indigo-700">
                            Author: <b>{{ $vM->publication->user->name}}</b> |
                            Created: <b>{{ $vM->publication->created_at->diffForHumans()}}</b> |
                            Updated: <b>{{ $vM->publication->updated_at->diffForHumans()}}</b>
                            <br>
                        </div>
                    </div>
                    <hr>
                    <div class="bg-gray-100 mt-4 mb-2">
                        @livewire('publication-comments', [
                        'title' => 'Comments',
                        'publication_id' => $vM->publication->id,
                        'state' => 'APPROVED'
                        ])
                    </div>
                    @if(!$vM->userHasCommentedPublication())
                    <div>
                        <h3 class="font-bold text-lg">Add comment</h3>
                        <form action="{{route('publication.comment.store', $vM->publication->getKey())}}" method="POST">
                            @csrf
                            <div>
                                <x-jet-label for="content" value="{{ __('Content') }}" />
                                <x-textarea id="content" name="content" required />
                            </div>
                            <x-jet-validation-errors class="mb-4" />
                            <div class="flex items-center justify-end mt-4">
                                <span class="text-sm">
                                    Note: The comment should be approved by the author.
                                </span>
                                <x-primary-button class="ml-4">
                                    Send
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                    @endif
                    <!-- TODO: show a state about his comment saved, if it is on hold, approved or rejected -->
                </div>
                <hr>
            </div>
        </div>
    </div>
</x-app-layout>
