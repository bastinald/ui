<?php

namespace DummyModelNamespace;

use Faker\Generator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;

class DummyModelClass extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function migration(Blueprint $table)
    {
        $table->id();
        $table->string('name');
        $table->timestamp('created_at')->nullable();
        $table->timestamp('updated_at')->nullable();
    }

    public function definition(Generator $faker)
    {
        return [
            'name' => $faker->name,
            'created_at' => $faker->dateTimeBetween(now()->subMonth(), now()),
        ];
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
        ];
    }
}
