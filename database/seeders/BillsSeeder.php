<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

use App\Models\Bills;
use Faker\Factory as Faker;

class BillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $accId = DB::table('accounts')->pluck('id')->toArray();
        $sbId = DB::table('status_bills')->pluck('id')->toArray();

        $faker = Faker::create();

        for ($i = 1; $i <= 5; $i++) {
            Bills::create([
                'addressUser' => $faker->address,
                'phoneUser' => $faker->phoneNumber,
                'nameUser' => $faker->name,
                'emailUser' => $faker->unique()->safeEmail, //Tạo email giả duy nhất và an toàn.
                'totalPrice' => $faker->randomFloat(2, 10, 1000),
                'paymentMethod' => $faker->numberBetween(1, 2),
                'account_id' => $faker->randomElement($accId),
                'statusBill_id' => $faker->randomElement($sbId),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
