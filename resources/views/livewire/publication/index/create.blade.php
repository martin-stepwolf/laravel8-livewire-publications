<div>
    <div class="mb-4 text-gray-600">
        Create publication
    </div>
    @include('livewire.publication.index.form')
    <div class="flex items-center justify-end mt-4">
        <x-jet-button class="ml-4" wire:click="store">
            Save
        </x-jet-button>
    </div>
</div>