<?php

namespace App\Models;

use Bastinald\Ui\Traits\HasHashes;
use Faker\Generator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class User extends Authenticatable
{
    use HasFactory, HasHashes, Notifiable;

    protected $guarded = [];
    protected $hashes = ['password'];
    protected $hidden = ['password', 'remember_token'];
    protected $casts = ['email_verified_at' => 'datetime'];

    public function migration(Blueprint $table)
    {
        $table->id();
        $table->string('name')->index();
        $table->string('email')->unique();
        $table->string('password');
        $table->rememberToken();
        $table->string('timezone')->nullable();
        $table->timestamp('email_verified_at')->nullable()->index();
        $table->timestamp('created_at')->nullable()->index();
        $table->timestamp('updated_at')->nullable();
    }

    public function definition(Generator $faker)
    {
        return [
            'name' => $faker->firstName,
            'email' => $faker->unique()->safeEmail,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'remember_token' => Str::random(10),
            'timezone' => $faker->timezone,
            'email_verified_at' => $faker->dateTimeBetween(now()->subMonth(), now()),
            'created_at' => $faker->dateTimeBetween(now()->subMonth(), now()),
        ];
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->id)],
            'password' => [!$this->exists ? 'required' : 'nullable', 'confirmed'],
        ];
    }
}
