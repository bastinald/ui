<div>
    <h5>Edit Profile</h5>

    <x-ui::input type="text" label="Username" data="name"/>
    <x-ui::input type="email" label="Email Address" data="email"/>
    <x-ui::image label="Avatar" data="avatar"/>

    <div class="d-flex gap-3">
        <x-ui::button action="$emit('hideModal')" label="Cancel" color="secondary" block/>
        <x-ui::button action="save" label="Save" block/>
    </div>
</div>
