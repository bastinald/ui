<div class="modal-dialog">
    <form class="modal-content" wire:submit.prevent="save">
        <div class="modal-header">
            <h5 class="modal-title">{{ !$DummyModelVariable->exists ? __('Create DummyViewTitle') : __('Update DummyViewTitle') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body pb-0">
            <x-ui::input :label="__('Name')" type="text" model="name"/>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
            <button type="submit" class="btn btn-primary">{{ __('Save DummyViewTitle') }}</button>
        </div>
    </form>
</div>
