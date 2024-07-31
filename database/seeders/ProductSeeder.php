<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

use App\Models\Product;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Xóa tất cả dữ liệu trong bảng products
        // Product::truncate();
        //khoi tao mang va get ra list foreign keys from table cate
        $cateId = DB::table('categories')->pluck('id')->toArray();

        $faker = Faker::create();

        for ($i = 1; $i <= 50; $i++) {
            Product::create([
                'name' => $faker->name,
                'img' => $faker->imageUrl($width = 640, $height = 480),
                'description' => $faker->sentence,
                'price' => $faker->randomFloat(2, 10, 1000),
                'quantity' => $faker->numberBetween(1, 100),
                'sold' => $faker->numberBetween(1, 100),
                'category_id' => $faker->randomElement($cateId),
            ]);
        }
    }
}
