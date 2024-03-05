<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name'      => 'Administrator',
            'email'     => 'admin@watch.com',
            'email_verified_at' => now(),
            'password'  => bcrypt('123456789'),
            'status'    => 1,
        ]);

        $user->assignRole('admin');
    }
}
