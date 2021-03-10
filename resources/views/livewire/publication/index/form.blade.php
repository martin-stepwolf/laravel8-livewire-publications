<div>
    <div class="mt-4">
        <x-jet-label for="title" value="{{ __('Title') }}" />
        <x-jet-input id="title" class="block mt-1 w-full" type="text" wire:model="title" required />
    </div>
    <div class="mt-4">
        <x-jet-label for="content" value="{{ __('Content') }}" />
        <textarea id="content" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" type="text" wire:model="content" required></textarea>
    </div>
    <x-jet-validation-errors class="mb-4" />
</div>