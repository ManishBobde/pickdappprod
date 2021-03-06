<?php

use App\FeedBack;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class FeedBackTableSeeder extends Seeder
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
            FeedBack::create ( [
                'feedBackText' => $faker->paragraph(),
                'updated_at' => $faker->dateTime,
                'created_at' => $faker->dateTime
            ] );
        }
    }
}
