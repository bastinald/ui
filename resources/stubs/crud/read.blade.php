<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">{{ __('Read DummyViewTitle') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body pb-0">
            <dl>
                <dt>{{ __('ID') }}</dt>
                <dd>{{ $DummyModelVariable->id }}</dd>

                <dt>{{ __('Name') }}</dt>
                <dd>{{ $DummyModelVariable->name }}</dd>

                <dt>{{ __('Created At') }}</dt>
                <dd>@displayDate($DummyModelVariable->created_at)</dd>

                <dt>{{ __('Updated At') }}</dt>
                <dd>@displayDate($DummyModelVariable->updated_at)</dd>
            </dl>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
        </div>
    </div>
</div>
