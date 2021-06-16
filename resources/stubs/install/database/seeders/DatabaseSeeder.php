<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        \App\Models\User::factory()->create([
            'email' => 'user@example.com',
        ]);

        // \App\Models\User::factory(100)->create();
    }
}
