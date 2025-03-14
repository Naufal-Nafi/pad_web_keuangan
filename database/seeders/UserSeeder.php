<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            User::create([
                'role' => 'pegawai',
                'email' => fake()->email(),
                'name' => fake()->name(),
                'password' => fake()->password(),
            ]);
        }
    }
}
