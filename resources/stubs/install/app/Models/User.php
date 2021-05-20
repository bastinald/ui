<?php

namespace App\Models;

use Bastinald\UI\Traits\HasFillable;
use Bastinald\UI\Traits\HasPassword;
use Faker\Generator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, HasFillable, HasPassword, Notifiable;

    protected $hidden = ['password', 'remember_token'];

    public function migration(Blueprint $table)
    {
        $table->id();
        $table->string('name')->unique();
        $table->string('email')->unique();
        $table->string('password');
        $table->rememberToken();
        $table->string('avatar')->nullable();
        $table->string('timezone')->nullable();
        $table->timestamp('created_at')->nullable();
        $table->timestamp('updated_at')->nullable();
    }

    public function definition(Generator $faker)
    {
        return [
            'name' => $faker->unique()->userName,
            'email' => $faker->unique()->safeEmail,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ];
    }
}
