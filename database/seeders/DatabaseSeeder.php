<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name'      => 'Administrator',
            'email'     => 'admin@watch.com',
            'password'  => bcrypt('123456789'),
            'role'      => \App\Models\User::ROLE_ADMIN,
        ]);
    }
}
