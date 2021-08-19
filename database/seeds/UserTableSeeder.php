<?php
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        DB::table('users')->insert([
            ["role_id" => 1, "name" => 'Admin 1', "email" => "admin1@readandwrite.com", "password" => Hash::make("admin12345")],
            ["role_id" => 1, "name" => 'Admin 2', "email" => "admin2@readandwrite.com", "password" => Hash::make("admin12345")],
            ["role_id" => 2, "name" => 'John Doe', "email" => "johndoe@gmail.com", "password" => Hash::make("john12345")],
            ["role_id" => 2, "name" => 'Ji Eun', "email" => "jieun@gmail.com", "password" => Hash::make("jieun12345")],
        ]);
    }
}
