@props(['title'])
<div class="modal-container" x-cloak
    x-data="{ visibily: @entangle($attributes->wire('model')) }"
    x-show="visibily"
    x-on:keydown.escape.window="Livewire.dispatchTo('{{ $this->getName() }}', 'close-modal')"
    >
    <style>
        [x-cloak] {
            display: none;
        }
    </style>
    <!-- Backdrop -->
    <div class="backdrop" x-show="visibily">
        <!-- Modal -->
        <div class="modal-content">
            <h1 class="modal-title">{{ $title }}</h1>
            {{ $slot }}
        </div>
    </div>
</div>
