<div id="modal" class="modal fade" tabindex="-1" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button"
                    class="btn-close position-absolute end-0 me-3"
                    wire:click="$emit('hideModal')"></button>

                @if($component)
                    @livewire($component, $data)
                @endif
            </div>
        </div>
    </div>
</div>
