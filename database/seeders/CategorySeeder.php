<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Category;
use App\Models\Product;
use Faker\Factory as Faker;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create(); //Tạo một đối tượng Faker để tạo dữ liệu giả
        //Vòng lặp for chạy 10 lần để tạo 10 bản ghi giả cho bảng categories.
        // Trong mỗi vòng lặp, sử dụng model Category để tạo một bản ghi mới trong bảng categories với các dữ liệu giả:
        // 'name' => $faker->word: Tạo một từ giả để làm tên danh mục.
        // 'description' => $faker->sentence: Tạo một câu giả để làm mô tả danh mục.
        for ($i = 0; $i < 10; $i++) {
            Category::create([
                'name' => $faker->name,
                'description' => $faker->sentence,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
