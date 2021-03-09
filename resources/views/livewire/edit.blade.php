<div>
    <h2>Edit publication {{ $publication_id }}</h2>
    @include('livewire.form')
    <button wire:click="update">
        Update
    </button>
    <button wire:click="default">
        Cancel
    </button>
</div>