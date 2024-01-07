<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Administrator2',
            'email' => 'admin2@admin.com',
            'password' => bcrypt('admin'),
            'email_verified_at' => now()
        ]);
    }
}
