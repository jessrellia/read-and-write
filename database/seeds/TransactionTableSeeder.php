<?php
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        DB::table('transactions')->insert([
            ['user_id' => 3, 'date' => $faker->dateTime()],
            ['user_id' => 4, 'date' => $faker->dateTime()],
            ['user_id' => 3, 'date' => $faker->dateTime()],
            ['user_id' => 4, 'date' => $faker->dateTime()],
        ]);
    }
}
