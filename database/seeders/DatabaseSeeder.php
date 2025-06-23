<?php

namespace Database\Seeders;

// database/seeders/DatabaseSeeder.php

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Dewan Ashraful Alam',
            'email' => 'alamdewan2012@gmail.com',
            'password' => Hash::make('password123'),
        ]);
    }
}
