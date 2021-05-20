<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        \App\Models\User::factory()->create([
            'name' => 'Tester',
            'email' => 'tester@example.com',
        ]);

        // \App\Models\User::factory(10)->create();
    }
}
