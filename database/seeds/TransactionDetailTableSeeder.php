<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transaction_details')->insert([
            ['transaction_id' => 1, 'product_id' => 1, 'quantity' => 1], 
            ['transaction_id' => 1, 'product_id' => 5, 'quantity' => 1], 
            ['transaction_id' => 1, 'product_id' => 10, 'quantity' => 2],

            ['transaction_id' => 2, 'product_id' => 9, 'quantity' => 3], 
            ['transaction_id' => 2, 'product_id' => 10, 'quantity' => 6],

            ['transaction_id' => 3, 'product_id' => 19, 'quantity' => 8],
            ['transaction_id' => 3, 'product_id' => 27, 'quantity' => 3],

            ['transaction_id' => 4, 'product_id' => 34, 'quantity' => 1],
            ['transaction_id' => 4, 'product_id' => 35, 'quantity' => 1],
            ['transaction_id' => 4, 'product_id' => 36, 'quantity' => 1],
            ['transaction_id' => 4, 'product_id' => 17, 'quantity' => 1]
        ]);
    }
}
