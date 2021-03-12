<div>
    <div class="mb-4 text-gray-600">
        Create publication
    </div>
    @include('livewire.publication-crud.form')
    <div class="flex items-center justify-end mt-4">
        <x-primary-button class="ml-4" wire:click="store">
            Save
        </x-primary-button>
    </div>
</div>