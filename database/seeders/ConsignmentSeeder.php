<?php

namespace Database\Seeders;

use App\Models\Consignment;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConsignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productIds = Product::pluck('product_id')->toArray();
        $storeIds = Store::pluck('store_id')->toArray();
        $userIds = User::pluck('user_id')->toArray();

        for ($i = 0; $i < 10; $i++) {
            Consignment::create([
                'product_id' => fake()->randomElement($productIds),
                'store_id' => fake()->randomElement($storeIds),
                'user_id' => fake()->randomElement($userIds),
                'entry_date' => fake()->date(),
                'exit_date' => fake()->date(),
                'stock' => fake()->numberBetween(30, 100),
                'sold' => fake()->numberBetween(10, 30),
                'price' => fake()->numberBetween(1000, 200000),
            ]);
        }
    }
}
