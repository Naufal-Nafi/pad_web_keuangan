<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'alganis@admin.com',
            'password' => Hash::make('admin12345'),
            'role' => 'owner',
        ]);
        $this->call([
            ProductSeeder::class,
            StoreSeeder::class,
            UserSeeder::class,
            ExpenseSeeder::class,
            ConsignmentSeeder::class,
        ]);
    }
}
