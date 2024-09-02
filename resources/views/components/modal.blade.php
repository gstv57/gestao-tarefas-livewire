@props(['title'])
<div class="modal-container" x-cloak
    x-data="{ visibily: @entangle($attributes->wire('model')) }"
    x-show="visibily"
    x-on:keydown.escape.window="Livewire.dispatchTo('{{ $this->getName() }}', 'close-modal')"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="transform scale-95 opacity-0"
     x-transition:enter-end="transform scale-100 opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="transform scale-100 opacity-100"
     x-transition:leave-end="transform scale-95 opacity-0">
    <style>
        [x-cloak] {
            display: none;
        }
    </style>
    <!-- Backdrop -->
    <div class="backdrop" x-show="visibily">
        <!-- Modal -->
        <div class="modal-content">
            <h1 class="modal-title text-black">{{ $title }}</h1>
            {{ $slot }}
        </div>
    </div>
</div>
