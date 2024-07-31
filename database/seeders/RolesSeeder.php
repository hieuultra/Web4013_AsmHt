<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Roles;
use App\Models\Accounts;
use Faker\Factory as Faker;

class RolesSeeder extends Seeder
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
        for ($i = 0; $i < 2; $i++) {
            Roles::create([
                'nameRole' => $faker->name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
