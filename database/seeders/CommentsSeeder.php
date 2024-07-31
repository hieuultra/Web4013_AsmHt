<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

use App\Models\Comments;
use Faker\Factory as Faker;

class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $accId = DB::table('accounts')->pluck('id')->toArray();
        $pId = DB::table('products')->pluck('id')->toArray();

        $faker = Faker::create();

        for ($i = 1; $i <= 5; $i++) {
            Comments::create([
                'content' => $faker->text,
                'account_id' => $faker->randomElement($accId),
                'product_id' => $faker->randomElement($pId),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
