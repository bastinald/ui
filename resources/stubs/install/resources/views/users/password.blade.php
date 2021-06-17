<div class="modal-dialog">
    <form class="modal-content" wire:submit.prevent="save">
        <div class="modal-header">
            <h5 class="modal-title">{{ __('Change User Password') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body pb-0">
            <x-ui::input :label="__('New Password')" type="password" model="password"/>
            <x-ui::input :label="__('New Confirm Password')" type="password" model="password_confirmation"/>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
            <button type="submit" class="btn btn-primary">{{ __('Save Password') }}</button>
        </div>
    </form>
</div>
