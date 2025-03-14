<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Author User',
            'email' => 'author@example.com',
            'password' => Hash::make('87654321'),
            'role' => 'author',
        ]);

        User::create([
            'name' => 'Subscriber User',
            'email' => 'subscriber@example.com',
            'password' => Hash::make('11111111'),
            'role' => 'user',
        ]);
    }
}
