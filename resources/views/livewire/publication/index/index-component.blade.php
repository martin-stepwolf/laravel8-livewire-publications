<div class="p-6 sm:px-20 bg-white border-b border-gray-200 grid grid-cols-1 lg:grid-cols-3">
    <div class="lg:pr-16">
        @include('livewire.publication.index.' . $view)
    </div>
    <div class="col-span-2">
        @include('livewire.publication.index.table')
    </div>
</div>