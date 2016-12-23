<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});
$factory->define(PD\Categories\Categories::class, function (Faker\Generator $faker) {
    return [
        'categoryname' => $faker->streetName
    ];
});
$factory->define(App\AndroidDevice::class, function (Faker\Generator $faker) {
    return [
        'deviceId' => $faker->name,
        'pushRegId' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'deviceModelName' => str_random(10),
        'osVersion' => str_random(10),
        'appVersion' => str_random(10),

    ];
});
$factory->define(App\Post::class, function (Faker\Generator $faker) {
    return [
        'postTitle' => $faker->title,
        'shortDescription' => $faker->sentence,
        'sourceName' => $faker->safeColorName,
        'sourceUrl' => $faker->url,
        'imageUrl' => $faker->imageUrl(),
        'categoryId' => str_random(10),
        'curatorId' => str_random(10),
        'createdDate' => $faker->date(),
        'publishedDate' => $faker->date()
    ];
});
$factory->define(App\Fact::class, function (Faker\Generator $faker) {
    return [
        'description' => $faker->sentence,
        'sourceName' => $faker->safeColorName,
        'sourceUrl' => $faker->url,
        'imageUrl' => $faker->imageUrl(),
        'categoryId' => str_random(10),
        'curatorId' => str_random(10),
        'createdDate' => $faker->date(),
        'publishedDate' => $faker->date()
    ];
});
$factory->define(App\FeedBack::class, function (Faker\Generator $faker) {
    return [
        'feedBackText' => $faker->sentences(20),
    ];
});
