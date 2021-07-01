# No Longer Maintained

Check out my new UI, Auth, & CRUD scaffolding package here: https://github.com/bastinald/laravel-livewire-ui

---

## bastinald/ui

Laravel Livewire & Bootstrap 5 UI & CRUD starter kit. This package is a modernized version of the old `laravel/ui` package for developers who prefer using Bootstrap 5 and full page Livewire components to build their projects. It also comes with a few features to boost your development speed even more.

<a href="https://www.youtube.com/watch?v=CYl1pMgiecU"><img src="https://i.imgur.com/jkp9nYW.png"></a>

### Requirements

- Laravel 8
- NPM

### Features

- Bootstrap 5 pre-configured
- Full auth scaffolding including login, register, forgot password, profile updating, etc.
- Commands for making models, components, and CRUD
- PWA capabilities
- Simply app versioning
- Automatic model migrations
- Automatic full page component routing
- Automatic attribute hashing
- Automatic user timezones
- Easy form data manipulation via a single property
- Dynamic Livewire Bootstrap modals
- Custom Blade components
- Font Awesome icons
- & more

### Documentation

- [Installation](#installation)
- [Commands](#commands)
- [Automatic Migrations](#automatic-migrations)
- [Automatic Routing](#automatic-routing)
- [Automatic Attribute Hashing](#automatic-attribute-hashing)
- [Form Data Manipulation](#form-data-manipulation)
- [Dynamic Bootstrap Modals](#dynamic-bootstrap-modals)
- [Blade Components](#blade-components)
- [Font Awesome Icons](#font-awesome-icons)
- [Publishing Assets](#publishing-assets)

## Installation

This package was designed to work with fresh Laravel projects.

Install Laravel via Valet, Docker, or whatever you prefer:

```console
laravel new my-project
```

Configure the `.env` app, database, and mail variables:

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

Once the installation is complete, you should be able to visit your app URL and login with `user@example.com` as the email, and `password` as the password. This was seeded for you to test with.

## Commands

### Installing UI

```console
php artisan ui:install
```

This command will create your Livewire auth components & views, update your User model & factory, migrate & seed a default User, configure Bootstrap 5 JavaScript & SCSS through NPM/Webpack, create an IDE helper file, and run the necessary NPM commands.

### Making Models

```console
php artisan ui:model {class} {--force}
```

This will make a model with an automatic `migration` method included. It will also make a factory for the model whose definition points to the model `definition` method.

Use the `--force` to overwrite existing models & factories.

### Making Components

```console
php artisan ui:component {class} {--f|--full} {--m|--modal} {--force}
```

This will make a Livewire component and view depending on which option you pass to it. Use the `-f` option to create a full page component with a `route` method, the `-m` option to create a modal component, or neither to create a partial component.

Use the `--force` to overwrite existing components & views.

### Making CRUD

```console
php artisan ui:crud {path}
```

This will make CRUD components & views for a given component path/namespace. This includes an index, create, read, update, and delete. It also comes with searching, sorting, and filtering, which is easily customizable inside the index component class.

For making CRUD inside of subfolders, simply use slashes or dot notation:

```console
# no subfolder
php artisan ui:crud Users 

# in an "Admin" subfolder
php artisan ui:crud Admin/Users 
```

If the model (e.g. `User` in the example above) does not already exist when making CRUD, it will ask if you want to make it. After generating CRUD, all you need to do is add your model fields to the component views. Check out the `Users` component & views that come with the package when you run `ui:install` for an example.

Use the `--force` to overwrite existing CRUD components & views.

### Running Automatic Migrations

```console
php artisan ui:migrate {--f|--fresh} {--s|--seed} {--force}
```

This command goes through your model `migration` methods and compares their schema's with the existing database table schema's. If any changes need to be made, it applies them automatically via Doctrine.

This command works well alongside traditional migration files. When you run this command, it will run your traditional migrations first, and the automatic migrations after. This is useful for cases where you don't need to couple a database table with a model (pivots, etc.).

Use the `-f` option to wipe the database (fresh), and the `-s` option to run your seeders after migration is complete. The `--force` is required to run migrations in production environments.

## Automatic Migrations

This package promotes the usage of automatic migrations.

To use automatic migrations, specify a `migration` method inside your models:

```php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;

class User extends Model
{
    public function migration(Blueprint $table)
    {
        $table->id();
        $table->string('name');
        $table->string('email')->unique();
        $table->timestamp('email_verified_at')->nullable();
        $table->string('password');
        $table->rememberToken();
        $table->timestamp('created_at')->nullable();
        $table->timestamp('updated_at')->nullable();
    }
}
```

Or, make a new model via the `ui:model` command, which will include a `migration` method for you:

```console
php artisan ui:model Vehicle
```

The `migration` method uses the `$table` Blueprint variable, just like in traditional Laravel migration files. As mentioned previously, when you run the `ui:migrate` command, it will compare your existing database table schema's to your model `migration` methods and apply the necessary changes via Doctrine. With this, you'll no longer have to manage tons of migration files.

## Automatic Routing

This package also promotes the usage of automatic routing.

To use automatic routing, specify a `route` method inside your full page Livewire components:

```php
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class Home extends Component
{
    public function route()
    {
        return Route::get('/home', static::class)
            ->name('home')
            ->middleware('auth');
    }
}
```

Or, just run the `ui:component` command with the `-f` option to quickly make a full page component including a `route` method:

```console
php artisan ui:component ContactUs -f
```

The `route` method returns the Laravel `Route` facade, just like you would use in route files. This means that your component route can do anything a normal Laravel route can do. These routes are registered through the package service provider automatically, so you'll no longer have to manage messy route files.

## Automatic Attribute Hashing

The `HasHashes` traits allows you to specify model attributes you want to hash automatically when they are saving to the database.

To use automatic hashing, use the `HashHashes` trait and specify a `hashes` property with the attributes that should be automatically hashed:

```php
use Bastinald\Ui\Traits\HasHashes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasHashes;

    protected $hashes = ['password'];
}
```

This trait will only automatically hash attribute values that are not already hashed, so it will not slow down seeders.

## Form Data Manipulation

The `WithModel` traits makes managing form data inside your Livewire components easy. Normally, you'd have to specify a property for every one of your form inputs. With this trait, all of your form data will be present in a `$model` property array. This trait also comes with some handy methods to get, set, and validate the data.

### Binding Model Data

Please note that all of the package `x-ui` Blade components will properly map the inputs to the component `$model` property and show relevant errors. If you are using your own HTML inputs, just be sure to prepend `model.` to the `wire:model` attribute.

For example, if you're using the package components, just specify the `$model` key directly via the `model` attribute:

```html
<x-ui::input :label="__('First Name')" type="text" model="first_name"/>
```

If you're using your own HTML inputs, make sure you prepend `model.` to the `wire:model.*` attribute:

```html
<label>First Name</label>
<input type="text" wire:model.defer="model.first_name"/>
@error('first_name') <p class="text-danger">{{ $message }}</p> @enderror
```

Notice how you don't prepend `model.` to the `@error`. Error messages use the `$model` key via the `validateModel` method, so you only need to prepend `model.` on the inputs.

### Getting Model Data

Getting all model data as an array:

```php
$this->getModel();
```

Getting an array of data:

```php
$this->getModel(['email', 'password']);
```

If you pass an array to the `getModel` property, it will always return an array, even if you only use a single key. This is useful for quickly updating a single model column via `create` or `update`.

Getting a single value:

```php
$this->getModel('first_name', 'Joe');
```

You can specify a default value via the second parameter, or omit it entirely.

### Setting Model Data

Setting an array of values:

```php
$this->setModel([
    'name' => 'Joe',
    'email' => 'joe@example.com',
]);
```

Setting a single value:

```php
$this->setModel('name', 'Joe');
```

### Resetting Model Data

You can reset all model data easily:

```php
$this->resetModel();
```

### Validating Model Data

The `validateModel` method works the same as the Livewire `validate` method, but will use the `$model` data for validation.

You can use it alongside a `rules` method:

```php
public function rules()
{
    return [
        'email' => ['required', 'email'],
        'password' => ['required'],
    ];
}

public function login()
{
    $this->validateModel();
    
    // log the user in
}
```

Or by itself, with rules passed directly:

```php
public function login()
{
    $this->validateModel([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);
    
    // log the user in
}
```

## Dynamic Bootstrap Modals

This package allows you to show Livewire components as modals dynamically by emitting a simple event. No more having to manage modal components everywhere in your views.

### Making Modals

Just use the `ui:component` command with the `-m` option to make a new modal component:

```console
php artisan ui:component TermsOfService -m
```

This will create a partial Livewire component and a view that contains the Bootstrap modal classes.

### Showing Modals

To show modals, just emit the `showModal` event.

You can emit this from your component views:

```html
<button type="button" wire:click="$emit('showModal', 'auth.password-change')">
    {{ __('Change Password') }}
</button>
```

Or from the component classes themselves:

```php
$this->emit('showModal', 'auth.password-change');
```

Notice that the second parameter is using the Livewire component class alias. So in this example, `auth.password-change` actually points to the `Auth\PasswordChange` component.

### Passing Mount Parameters

You can pass any parameters you want to your modal component `mount` method by specifying them in the `showModal` event:

Passing parameters via component views:

```html
<button type="button" wire:click="$emit('showModal', 'users.update', {{ $user->id }})">
    {{ __('Update User') }}
</button>
```

Or from a component class:

```php
$this->emit('showModal', 'users.update', $user->id);
```

Now, in our component `mount` method, we can use this parameter:

```php
public $user;

public function mount(User $user)
{
    $this->user = $user;
}
```

Notice how even model binding works here. If you need to pass more than one parameter, just keep adding them to the `showModal` emit, separated by a comma.

### Hiding Modals

Hide the currently open modal via the `hideModal` event:

```html
<button type="button" wire:click="$emit('hideModal')">
    {{ __('Close') }}
</button>
```

Or, through component classes:

```php
$this->emit('hideModal');
```

You can also hide the modal through regular Bootstrap `data-bs-toggle` buttons:

```html
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
    {{ __('Cancel') }}
</button>
```

## Blade Components

This package comes with some handy Blade components, ensuring that you stay DRY, while keeping your markup nice and neat.

### Input

A form input:

```html
<x-ui::input :label="__('Email')" type="email" model="email"/>
```

Available props:

- `label`: the input label
- `type`: the input type e.g. `text`, `email`, `file`
- `model`: the key for the component `$model` property
- `lazy`: bind the model value on change
- `debounce="x"`: debounce the model value after `x` ms (defaults to `150`)

If `lazy` and `debounce` are not used, `defer` is the default.

### Textarea

A textarea input:

```html
<x-ui::textarea :label="__('Biography')" rows="5" model="biography"/>
```

Available props:

- `label`: the textarea label
- `model`: the key for the component `$model` property
- `lazy`: bind the model value on change
- `debounce="x"`: debounce the model value after `x` ms (defaults to `150`)

The `lazy` and `debounce` props work the same as the `input` component.

### Select

A select input:

```html
<x-ui::select :label="__('Color')" options="['Red', 'Blue']" model="color"/>
```

Available props:

- `label`: the select label
- `options`: an array of select options
- `model`: the key for the component `$model` property
- `lazy`: bind the model value on change

The `options` array can be an indexed or associative array. If the array is associative, the array keys will be used for the option values, and the array values will be used for the option labels. If the array is indexed, it's values will be used for both the option values and labels.

### Radio

A radio input:

```html
<x-ui::radio :label="__('Color')" options="['Red', 'Blue']" model="color"/>
```

Available props:

- `label`: the radio label
- `options`: an array of radio options
- `model`: the key for the component `$model` property
- `lazy`: bind the model value on change

The `options` array works the same as the `select` component.

### Checkbox

A checkbox input:

```html
<x-ui::checkbox :label="__('Agree to TOS')" model="agree"/>
```

Available props:

- `label`: the checkbox label
- `model`: the key for the component `$model` property
- `lazy`: bind the model value on change

### Dropdown

A dropdown button:

```html
<x-ui::dropdown icon="filter" :label="__($filter)">
    @foreach($filters as $filter)
        <x-ui::dropdown-item :label="__($filter)" click="$set('filter', '{{ $filter }}')"/>
    @endforeach
</x-ui::dropdown>
```

Available props:

- `icon`: the dropdown button icon (Font Awesome)
- `label`: the dropdown button label
- `position`: the dropdown menu position (defaults to `end`)
- `slot`: the dropdown items

### Dropdown Item

A dropdown item button:

```html
<x-ui::dropdown-item :label="__('Logout')" click="logout"/>
```

Available props:

- `label`: the dropdown item button label
- `route`: the route to link to
- `url`: the URL to link to
- `href`: the link href
- `click`: the Livewire click action

### Action

A CRUD action button:

```html
<x-ui::action icon="eye" :title="__('Read')"
    click="$emit('showModal', 'users.read', {{ $user->id }})"/>
```

Available props:

- `icon`: the action button icon (Font Awesome)
- `title`: the action button title
- `route`: the route to link to
- `url`: the URL to link to
- `href`: the link href
- `click`: the Livewire click action

### Pagination

Responsive pagination links:

```html
<x-ui::pagination :links="$users"/>
```

Available props:

- `links`: the pagination link results
- `count`: show the count to the left (`true` or `false`)
- `justify`: the justification for the links

### Icon

A Font Awesome icon:

```html
<x-ui::icon name="laravel" style="brands"/>
```

Available props:

- `name`: the icon name
- `style`: the icon style e.g. `solid`, `regular` (default set in config)

## Font Awesome Icons

When running the `ui:install` command, you are given the option to install Font Awesome free or pro. If you select pro, you are required to have a global NPM token configured.

For information on how to configure this token, [please see the Font Awesome documentation](https://fontawesome.com/v5.15/how-to-use/on-the-web/setup/using-package-managers#installing-pro).

## Publishing Assets

Publish the package config, stubs, and views via the `vendor:publish` command:

```console
php artisan vendor:publish
```

Select `ui:config`, `ui:stubs`, `ui:views`, or `ui` for all assets.

### Using Custom Stubs

Once you have published the package config and stub files, the stubs will be located in the `resources/stubs/vendor/ui` folder.

Update the `config/ui.php` file and point the `stub_path` to this path:

```php
'stub_path' => resource_path('stubs/vendor/ui'),
```

The commands will now use this path for the stubs. Customize them to your needs.
