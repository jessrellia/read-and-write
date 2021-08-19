<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StationaryTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stationary_types')->insert([
            ["name" => 'notebook', "image" => "stationary-type/notebook.png"],
            ["name" => "pencil", "image" => "stationary-type/pencil.png"],
            ["name" => 'pen', "image" => "stationary-type/pen.png"],
            ["name" => 'marker', "image" => "stationary-type/marker.png"],
            ["name" => 'brush pen', "image" => "stationary-type/brush pen.png"],
            ["name" => 'ruler', "image" => "stationary-type/ruler.png"],
            ["name" => 'dictionary', "image" => "stationary-type/dictionary.png"]
        ]);
    }
}
