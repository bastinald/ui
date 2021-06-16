<div class="modal fade" tabindex="-1" data-bs-backdrop="static" wire:ignore.self>
    @if($component)
        @livewire($component, $params)
    @endif
</div>

@push('scripts')
    <script>
        let modalElement = document.querySelector('.modal');

        modalElement.addEventListener('hidden.bs.modal', () => {
            Livewire.emit('resetModal');
        });

        Livewire.on('showBootstrapModal', () => {
            let modal = new window.bootstrap.Modal(modalElement);

            modal.show();
        });

        Livewire.on('hideModal', () => {
            let modal = window.bootstrap.Modal.getInstance(modalElement);

            modal.hide();
        });
    </script>
@endpush
