<?php

use App\AndroidDevice;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class AndroidDeviceTableSeeder extends Seeder
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
            AndroidDevice::create ( [
                'deviceId' => $faker->name,
                'deviceType' => "1",
                'osType' => "5.4",
                'pushRegId' => $faker->randomNumber(8),
                'deviceModelName' => str_random(10),
                'osVersion' =>  $faker->randomFloat(),
                'appVersion' => "1.0",
                'updated_at' => $faker->dateTime,
                'created_at' => $faker->dateTime
            ] );
        }
    }
}
