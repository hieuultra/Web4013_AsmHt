<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

use App\Models\Feedbacks;
use Faker\Factory as Faker;

class FeedbacksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sfId = DB::table('status_feedbacks')->pluck('id')->toArray();

        $faker = Faker::create();

        for ($i = 1; $i <= 5; $i++) {
            Feedbacks::create([
                'nameUser' => $faker->name,
                'emailUser' => $faker->unique()->safeEmail, //Tạo email giả duy nhất và an toàn.
                'phoneUser' => $faker->phoneNumber,
                'content' => $faker->text,
                'status_feedbacks_id' => $faker->randomElement($sfId),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
