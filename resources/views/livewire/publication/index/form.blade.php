<div>
    <div class="mt-4">
        <x-jet-label for="title" value="{{ __('Title') }}" />
        <x-jet-input id="title" class="block mt-1 w-full" type="text" wire:model="title" required />
    </div>
    <div class="mt-4">
        <x-jet-label for="content" value="{{ __('Content') }}" />
        <x-textarea id="content" wire:model="content" required />
    </div>
    <x-jet-validation-errors class="mb-4" />
</div>