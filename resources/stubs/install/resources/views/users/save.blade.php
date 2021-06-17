<div class="modal-dialog">
    <form class="modal-content" wire:submit.prevent="save">
        <div class="modal-header">
            <h5 class="modal-title">{{ !$user->exists ? __('Create User') : __('Update User') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body pb-0">
            <x-ui::input :label="__('Name')" type="text" model="name"/>
            <x-ui::input :label="__('Email')" type="email" model="email"/>

            @if(!$user->exists)
                <x-ui::input :label="__('Password')" type="password" model="password"/>
                <x-ui::input :label="__('Confirm Password')" type="password" model="password_confirmation"/>
            @endif
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
            <button type="submit" class="btn btn-primary">{{ __('Save User') }}</button>
        </div>
    </form>
</div>
