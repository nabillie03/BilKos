<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@simkos.test'],
            [
                'name' => 'Admin Kos',
                'password' => Hash::make('password'),
                'phone' => '081234567890',
                'role' => 'admin',
            ]
        );
    }
}