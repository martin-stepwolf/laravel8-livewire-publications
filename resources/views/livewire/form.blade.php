<div>
    <div>
        <label>Title</label>
        <input type="text" wire:model="title">
        @error('title') <span>{{ $message }}</span> @enderror
    </div>
    <div>
        <label>Content</label>
        <textarea wire:model="content"></textarea>
        @error('content') <span>{{ $message }}</span> @enderror
    </div>
</div>