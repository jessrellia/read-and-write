<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(StationaryTypeTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(TransactionTableSeeder::class);
        $this->call(TransactionDetailTableSeeder::class);
    }
}

