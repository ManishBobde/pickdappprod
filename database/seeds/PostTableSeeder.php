<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class PostTableSeeder extends Seeder
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
            \App\Post::create ( [
                'postTitle' => $faker->title,
                'shortDescription' => $faker->paragraph(5),
                'sourceName' => $faker->safeColorName,
                'sourceUrl' => $faker->url,
                'imageUrl' => $faker->imageUrl(),
                'categoryId' => $faker->randomDigit,
                'curatorId' => $faker->randomDigit,
                'createdDate' => $faker->date(),
                'publishedDate' => $faker->date(),
                'updated_at' => $faker->dateTime,
                'created_at' => $faker->dateTime,
                'isVideoPost'=>$faker->boolean()
            ] );
        }
    }
}
