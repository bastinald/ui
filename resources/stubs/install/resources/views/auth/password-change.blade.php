<div>
    <h5>Change Password</h5>

    <x-ui::input type="password" label="Current Password" data="current_password"/>
    <x-ui::input type="password" label="New Password" data="password"/>
    <x-ui::input type="password" label="Confirm New Password" data="password_confirmation"/>

    <div class="d-flex gap-3">
        <x-ui::button action="$emit('hideModal')" label="Cancel" color="secondary" block/>
        <x-ui::button action="save" label="Save" block/>
    </div>
</div>
