<div class="p-6 sm:px-20 bg-white border-b border-gray-200 grid grid-cols-1 lg:grid-cols-3">
    <div class="lg:pr-16">
        <div class="border p-4 mt-3 mb-6 bg-gray-100">
            Here you can manage only your publication (create, update and delete).
        </div>
        @include('livewire.publication.index.' . $view)
    </div>
    <div class="col-span-2">
        <div class="my-2">
            <x-jet-input class="block mt-1 w-full" type="text" wire:model="q" placeholder="Search by title or content" />
        </div>
        @include('livewire.publication.index.table')
    </div>
</div>