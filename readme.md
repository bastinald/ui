# bastinald/ui

Laravel + Livewire + Bootstrap 5 UI starter kit.

### Requirements

- Laravel 8
- NPM

### Features

- Bootstrap 5 pre-configured
- Textarea autosize
- Floating input labels
- Dynamic Livewire modals
- FontAwesome icons
- Full auth scaffolding
- User avatars
- Automatic password hashing
- Automatic user timezones
- Automatic Livewire component routing
- Automatic model migrations
- Automatic model fillables from database columns
- Easy form data usage & validation
- Login rate limiting
- Honeypot & reCAPTCHA registration protection
- Password forgot & reset functionality
- Profile editing & password changing functionality
- Simple app versioning
- Logo, fav icon, & touch icons
- PWA capabilities via a manifest
- Commands for automatic migrations, making components & models
- Components for inputs, buttons, dropdowns, links, & more

## Installation

Create a new Laravel app:

```console
laravel new my-app
```

Configure `.env` app, database, and mail values:

```env
APP_*
DB_*
MAIL_*
```

Require this package via composer:

```console
composer require bastinald/ui
```

Run the `ui:install` command:

```console
php artisan ui:install
```

Once installation is complete, you can visit your app URL and login, register, edit your profile, etc. Check out the `app/Components`, `app/Models`, and `resources/views` folders to see some of the code that was generated for you.

## Commands

### Automatic Migrations

```console
php artisan ui:migrate {--f} {--s} {--fs}
```

This will run the automatic migrations by comparing the `migration` methods of your models to the current database table structures and apply any necessary changes. Use the `--f` option for fresh, `--s` for seed, or `--fs` for both.

### Making Components

```console
php artisan ui:component {class} {--f}
```

This will generate a Livewire component. Use the `--f` option to make a full-page component with automatic routing included via a `route` method.

### Making Models

```console
php artisan ui:model {class}
```

This will generate an Eloquent model including a `migration` and `definition` method for use with the `ui:migrate` command. It also creates a factory for the model.

## Components

### Box

```html
<x-ui::box col="5">
    <h5>@yield('title')</h5>

    <p class="mb-0">You are logged in!</p>
</x-ui::box>
```

A content box. 

- `col` - the column width of the box (omit for full-width)
- `slot` - can contain whatever you want

### Button

```html
<x-ui::button action="login" label="Login" block/>
<x-ui::button :href="route('login')" label="Login" color="light"/>
<x-ui::button action="login" icon="sign-in-alt" size="lg"/>
```

A button.

- `color` - the Bootstrap button color (defaults to `primary`)
- `size` - the Bootstrap button size (accepts `lg` or `sm`)
- `block` - makes the button full-width
- `action` - the Livewire action when the button is clicked
- `icon` - the FontAwesome icon name for the button (e.g. `cog`)
- `label` - the label for the button

### Check

```html
<x-ui::check label="Remember me" data="remember"/>
```

A checkbox input. Use `WithData` in your Livewire component for this.

- `data` - the Livewire data binding key
- `lazy` - bind the data on change
- `defer` - bind the data on action (default)
- `label` - the label for the checkbox

### Dropdown

```html
<x-ui::dropdown icon="link" label="A Dropdown">
    <x-ui::dropdown-item action="doSomething" icon="check" label="Do Something"/>
    <x-ui::dropdown-item :href="route('somewhere')" label="Go Somewhere"/>
</x-ui::dropdown>
```

A dropdown button.

- `color` - the Bootstrap button color (defaults to `primary`)
- `size` - the Bootstrap button size (accepts `lg` or `sm`)
- `block` - make the dropdown full-width
- `icon` - the FontAwesome icon name for the button (e.g. `cog`)
- `label` - the label for the button
- `slot` - should contain `dropdown-item` and `dropdown-header`

### Dropdown Header

```html
<x-ui::dropdown-header label="A Dropdown Header"/>
```

A dropdown header.

- `label` - the label for the header

### Dropdown Item

```html
<x-ui::dropdown-item action="doSomething" icon="check" label="Do Something"/>
<x-ui::dropdown-item :href="route('somewhere')" label="Go Somewhere"/>
```

A dropdown item.

- `action` - the Livewire action when the item is clicked
- `icon` - the FontAwesome icon name for the item (e.g. `cog`)
- `label` - the label for the item

### Image

```html
<x-ui::image label="Avatar" data="avatar"/>
```

An image upload input. Use `WithData` and `WithFileUploads` in your Livewire component for this.

- `data` - the Livewire data binding key
- `label` - the label for the input

### Input

```html
<x-ui::input type="email" label="Email Address" data="email"/>
```

An input field. Use `WithData` in your Livewire component for this.

- `data` - the Livewire data binding key
- `instant` - bind the data on keyup
- `lazy` - bind the data on change
- `debounce` - bind the data on debounce (ms)
- `defer` - bind the data on action (default)
- `label` - the label for the input

### Link

```html
<x-ui::link :href="route('login')" label="Login to account"/>
<x-ui::link action="doSomething" label="Do something else"/>
```

A link.

- `action` - the Livewire action when the link is clicked
- `icon` - the FontAwesome icon name for the link (e.g. `cog`)
- `label` - the label for the link

### Nav Dropdown

```html
<x-ui::nav-dropdown icon="user">
    <x-ui::dropdown-item action="$emit('showModal', 'auth.profile-edit')" label="Edit Profile"/>
    <x-ui::dropdown-item action="$emit('showModal', 'auth.password-change')" label="Change Password"/>
    <x-ui::dropdown-item :href="route('logout')" label="Logout"/>
</x-ui::nav-dropdown>
```

A nav dropdown button.

- `icon` - the FontAwesome icon name for the button (e.g. `cog`)
- `label` - the label for the button
- `slot` - should contain `dropdown-item` and `dropdown-header`

### Nav Item

```html
<x-ui::nav-item :href="route('login')" label="Login"/>
<x-ui::nav-item action="doSomething" icon="link"/>
```

A nav item button.

- `action` - the Livewire action when the button is clicked
- `icon` - the FontAwesome icon name for the button (e.g. `cog`)
- `label` - the label for the button

### Radio

```html
<x-ui::radio :options="['Red', 'Green', 'Blue']" data="color"/>
<x-ui::radio :options="['#ff0000' => 'Red', '#00ff00' => 'Green', '#0000ff' => 'Blue']" data="color"/>
<x-ui::radio :options="App\Models\User::pluck('name', 'id')->toArray()" data="user_id"/>
```

A radio input. Use `WithData` in your Livewire component for this.

- `options` - an array of radio options (`$value => $label`)
- `data` - the Livewire data binding key
- `lazy` - bind the data on change
- `defer` - bind the data on action (default)

### Select

```html
<x-ui::select :options="['Red', 'Green', 'Blue']" label="Color" data="color"/>
<x-ui::select :options="['#ff0000' => 'Red', '#00ff00' => 'Green', '#0000ff' => 'Blue']" label="Hex Color" data="hex_color"/>
<x-ui::select :options="App\Models\User::pluck('name', 'id')->toArray()" label="User ID" data="user_id"/>
```

A select input. Use `WithData` in your Livewire component for this.

- `options` - an array of select options (`$value => $label`)
- `data` - the Livewire data binding key
- `lazy` - bind the data on change
- `defer` - bind the data on action (default)
- `label` - the label for the select

### Textarea

```html
<x-ui::textarea label="Biography" data="email"/>
```

An autosized textarea field. Use `WithData` in your Livewire component for this.

- `data` - the Livewire data binding key
- `instant` - bind the data on keyup
- `lazy` - bind the data on change
- `debounce` - bind the data on debounce (ms)
- `defer` - bind the data on action (default)
- `label` - the label for the textarea

## Dynamic Modals

Dynamic modals are Livewire components that are showed inside of modals dynamically when the `showModal` event is emitted.

For example, the `App\Components\Auth\PasswordChange` Livewire component:

```php
namespace App\Components\Auth;

class PasswordChange extends Component
{
    use WithData;
    
    public function render()
    {
        return view('auth.password-change');
    }
```

The `auth.password-change` view:

```html
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
```

### Showing Modals

Show a component inside of a modal via it's Livewire class alias e.g. `auth.password-change`:

```html
<x-ui::dropdown-item action="$emit('showModal', 'auth.password-change')" label="Change Password"/>
```

You can also show modals via your Livewire components:

```php
$this->emit('showModal', 'auth.password-change');
```

### Hiding Modals

Hide the currently open modal by emitting the `hideModal` event:

```html
<x-ui::button action="$emit('hideModal')" label="Cancel" color="secondary" block/>
```

Or, hide the modal via your Livewire components:

```php
$this->emit('hideModal');
```

### Modal Parameters

Pass parameters to your modal component `mount` method the same way you would with regular Livewire components:

```html
<x-ui::button action="$emit('showModal', 'edit-user', {{ $user->id }})" label="Edit User"/>
```

The mount method for your Livewire component would look something like this:

```php
class EditUser extends Component 
{
    public $user;
    
    public function mount(User $user)
    {
        $this->user = $user;
    }
}
```

Notice how even automatic model binding works.

## Traits

### HasFillable

Sets an Eloquent model `$fillable` to be equal to the model database table column names.

### HasPassword

Automatically hashes an Eloquent model `password` attribute if it is not empty and not already hashed.

### WithData

Makes dealing with form data easier by adding a `$data` array property to a Livewire component. This array is used by the package UI components such as inputs, selects, textarea's, etc.

#### Validating Data

```php
use WithData;

public function rules()
{
    return [
        'email' => 'required|email',
        'password' => 'required',
    ];
}

public function login()
{
    $this->validateData();

    //
}
```

The `validateData` method validates current data.

#### Getting Data

```php
Auth::user()->update($this->getData());
$this->getData('avatar');
$this->getData(['email', 'password']);
```

The `getData` method gets data by its key. If the key is an array, it will return an array of all data with the given keys. Omit the key entirely to return an array of all current data. Dot notation for the key is supported.

#### Setting Data

```php
$this->setData(Auth::user()->toArray());
$this->setData('email', $email);
```

Sets data using a key and value. If the key is an array, it will set data values per array key.

#### hasUploadedData

```php
if ($this->hasUploadedData('avatar')) {
    $avatar = $this->getData('avatar');
    $path = $avatar->hashName('avatars');

    Storage::put($path, Image::make($avatar)->fit(100)->encode());

    $this->setData('avatar', $path);
}
```

Checks to see if the current data for a given key is an uploaded file. Be sure to use this alongside `WithFileUploads`.
