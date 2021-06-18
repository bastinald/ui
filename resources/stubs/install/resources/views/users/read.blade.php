<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">{{ __('Read User') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body pb-0">
            <dl>
                <dt>{{ __('ID') }}</dt>
                <dd>{{ $user->id }}</dd>

                <dt>{{ __('Name') }}</dt>
                <dd>{{ $user->name }}</dd>

                <dt>{{ __('Email') }}</dt>
                <dd>{{ $user->email }}</dd>

                <dt>{{ __('Timezone') }}</dt>
                <dd>{{ $user->timezone ?? __('Empty') }}</dd>

                <dt>{{ __('Email Verified At') }}</dt>
                <dd>@displayDate($user->email_verified_at)</dd>

                <dt>{{ __('Created At') }}</dt>
                <dd>@displayDate($user->created_at)</dd>

                <dt>{{ __('Updated At') }}</dt>
                <dd>@displayDate($user->updated_at)</dd>
            </dl>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
        </div>
    </div>
</div>
