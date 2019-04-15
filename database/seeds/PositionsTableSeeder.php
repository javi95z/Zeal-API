<?php

use Illuminate\Database\Seeder;
use App\Position;

use Faker\Factory as Faker;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $rows = 10;
        for ($i=0; $i < $rows; $i++) { 
            $position = new Position;
            $position->title = $faker->jobTitle;
            $position->description = $faker->paragraph;
            $position->color = $faker->hexcolor;
            $position->save();
        }
    }
}