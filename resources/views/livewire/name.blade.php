<div class="z-10">
    <h1 class="text-2xl md:text-3xl xl:text-4xl font-display text-white leading-tight text-shadow text-center relative z-10 font-display py-8">{{ $name }}</h1>

    <div class="mb-4 text-center">
        <button wire:click="generate" class="bg-pink text-white hover:bg-purple py-2 px-8" style="transform: rotate({{$rotation}}deg);">Gimme Another</button>
    </div>
</div>
