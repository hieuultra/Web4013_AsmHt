<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

use App\Models\Cart;
use Faker\Factory as Faker;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $accId = DB::table('accounts')->pluck('id')->toArray();
        $pId = DB::table('products')->pluck('id')->toArray();
        $bId = DB::table('bills')->pluck('id')->toArray();

        $faker = Faker::create();

        for ($i = 1; $i <= 5; $i++) {
            Cart::create([
                'namePro' => $faker->name,
                'imagePro' => $faker->imageUrl($width = 640, $height = 480),
                'pricePro' => $faker->randomFloat(2, 10, 1000),
                'quantity' => $faker->numberBetween(1, 100),
                'total' => $faker->randomFloat(2, 10, 100000),
                'account_id' => $faker->randomElement($accId),
                'product_id' => $faker->randomElement($pId),
                'bill_id' => $faker->randomElement($bId),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
