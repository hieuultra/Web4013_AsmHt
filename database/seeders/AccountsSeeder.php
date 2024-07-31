<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

use App\Models\User;
use Faker\Factory as Faker;

class AccountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleId = DB::table('roles')->pluck('id')->toArray();

        $faker = Faker::create();

        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => $faker->name,
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'email' => $faker->unique()->safeEmail, //Tạo email giả duy nhất và an toàn.
                'username' => $faker->unique()->userName,
                'password' => bcrypt('password'),
                'image' => $faker->imageUrl($width = 640, $height = 480),
                'role_id' => $faker->randomElement($roleId),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
