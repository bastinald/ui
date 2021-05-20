<div>
    <h5>Edit Profile</h5>

    <x-ui::input type="text" label="Username" model="name"/>
    <x-ui::input type="email" label="Email Address" model="email"/>
    <x-ui::image label="Avatar" model="avatar"/>

    <div class="d-flex gap-3">
        <x-ui::button action="$emit('hideModal')" label="Cancel" color="secondary" block/>
        <x-ui::button action="save" label="Save" block/>
    </div>
</div>
