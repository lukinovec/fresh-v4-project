<div>
    <h1>{{ $count }}</h1>

    <button wire:click="increment">+</button>

    <button wire:click="decrement">-</button>

    <form wire:submit="save">
        @if ($photo)
            img ({{$photo->temporaryUrl()}})
            {{ $photo }}
            <img src="{{ $photo->temporaryUrl() }}">
        @endif

        <input type="file" wire:model="photo">

        @error('photo') <span class="error">{{ $message }}</span> @enderror

        <button type="submit">Save photo</button>
    </form>
</div>
