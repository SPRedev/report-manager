<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'amine@sarlpro.com'],
            [
                'name' => 'amine',
                'password' => Hash::make('1234'),
                'role' => 'admin',
            ]
        );
    }
}
