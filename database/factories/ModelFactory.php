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

$factory->define(App\Action::class, function (Faker\Generator $faker) {
    return [
        'name' => array_rand(App\Enums\ActionType::getKeys()),
        'body' => $faker->paragraph(),
    ];
});

$factory->define(App\Announcement::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word(),
        'body' => $faker->paragraph(),
    ];
});

$factory->define(App\Badge::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word(),
        'label' => $faker->word(),
    ];
});

$factory->define(App\Ban::class, function (Faker\Generator $faker) {
    return [
        'expires' => $faker->dateTime(),
    ];
});

$factory->define(App\Flag::class, function (Faker\Generator $faker) {
    return [
        'type' => array_rand(App\Enums\FlagType::getKeysInverse()),
        'status' => array_rand(App\Enums\FlagStatusType::getKeysInverse()),
        'body' => $faker->sentence(),
    ];
})

$factory->define(App\Ip::class, function (Faker\Generator $faker) {
    return [
        'ip' => $faker->ipv4(),
    ];
});

$factory->define(App\Permission::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word(),
        'label' => $faker->word(),
    ];
});

$factory->define(App\Poll::class, function (Faker\Generator $faker) {
    return [
        'question' => $faker->sentence(),
        'multiple' => $faker->boolean(),
    ];
});

$factory->define(App\Post::class, function (Faker\Generator $faker) {
    return [
        'syntax' => array_rand(App\Enums\SyntaxType::getKeysInverse()),
        'body' => $faker->paragraph(),
    ];
});

$factory->define(App\Role::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word(),
        'label' => $faker->word(),
    ];
});

$factory->define(App\Tag::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word(),
    ];
});

$factory->define(App\Thread::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->sentence(),
        'link' => $faker->url(),
        'nsfw' => $faker->boolean(),
        'views' => mt_rand(0, 100),
    ];
});

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'verified' => true,
    ];
});