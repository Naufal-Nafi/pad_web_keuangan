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

        // data 4 different timeframes
        $timeFrames = [
            ['start' => '-7 days', 'count' => 10],    // 7 days
            ['start' => '-14 days', 'count' => 15],   // 14 days
            ['start' => '-30 days', 'count' => 20],   // 1 month
            ['start' => '-1 year', 'count' => 55]     // 1 year
        ];

        foreach ($timeFrames as $frame) {
            for ($i = 0; $i < $frame['count']; $i++) {
                $entryDate = fake()->dateTimeBetween($frame['start'], 'now');
                
                // exit date 10-40 days after entry
                $exitDate = clone $entryDate;
                $exitDate->modify('+' . fake()->numberBetween(10, 40) . ' days');

                // stock > sold
                $stock = fake()->numberBetween(30, 100);
                $sold = fake()->numberBetween(10, min($stock, 30));

                Consignment::create([
                    'product_id' => fake()->randomElement($productIds),
                    'store_id' => fake()->randomElement($storeIds),
                    'user_id' => fake()->randomElement($userIds),
                    'entry_date' => $entryDate,
                    'exit_date' => $exitDate,
                    'stock' => $stock,
                    'sold' => $sold,                    
                ]);
            }
        }
    }
}
