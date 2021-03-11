<div>
    <div class="mb-4 text-gray-600">
        Edit publication {{ $publication_id }}
    </div>
    @include('livewire.publication.index.form')
    <div class="flex items-center justify-end mt-4">
        <x-primary-button class="ml-4" wire:click="update">
            Update
        </x-primary-button>
        <x-jet-danger-button class="ml-4" wire:click="default">
            Cancel
        </x-jet-danger-button>
    </div>
</div>