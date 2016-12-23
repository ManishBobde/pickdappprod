<?php

use App\Fact;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class FactTableSeeder extends Seeder
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
            Fact::create ( [
                'description' => $faker->paragraph(4),
                'sourceName' => $faker->safeColorName,
                'sourceUrl' => $faker->url,
                'categoryId' => $faker->randomDigit,
                'curatorId' => $faker->randomDigit,
                'createdDate' => $faker->date(),
                'publishedDate' => $faker->date(),
                'updated_at' => $faker->dateTime,
                'created_at' => $faker->dateTime
            ] );
        }
    }
}
