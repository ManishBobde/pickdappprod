<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use PD\Categories\Categories;


class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create ();
        foreach ( range ( 1, 10 ) as $index ) {
            Categories::create ( [
                'categoryname' => $faker->streetName,
                'updated_at' => $faker->dateTime,
                'created_at' => $faker->dateTime
            ] );
        }
    }
}
