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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
/*$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];


});*/


$factory->define(App\Models\Blog\Blog::class, function (Faker\Generator $faker) {
    return [
        'user_id' => $faker->randomElement(array('1','2')),
        'active' => $faker->randomElement(array('1','0')),
        'place' => $faker->address,
    ];
});

$factory->define(App\Models\Blog\BlogData::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence($nbWords = 4, $variableNbWords = true),
        'subtitle' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'content' => $faker->text($maxNbChars = 200),
        'slug' => $faker->slug,
        'lang' => $faker->randomElement(array('it','en')),
       
    ];
});


$factory->define(App\Models\Core\Category::class, function (Faker\Generator $faker) {
    return [
        'parent_id' => '1',
    ];
});

$factory->define(App\Models\Core\CategoryData::class, function (Faker\Generator $faker) {
    return [
        'category_id' => factory(App\Models\Core\Category::class)->create()->category_id,
        'name' => $faker->colorName,
        'slug' => $faker->colorName,
        'lang' => $faker->randomElement(array('it','en')),
    ];
});

$factory->define(App\Models\ContactRequests\ContactRequest::class, function (Faker\Generator $faker) {
    return [
        'subject' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'name' => $faker->firstName,
        'surname' => $faker->lastName,
        'company' => $faker->company,
        'email' => $faker->safeEmail,
        'phone' => $faker->e164PhoneNumber,
        'message' => $faker->text($maxNbChars = 150),
        'created_at' => $faker->date($format = 'Y-m-d H:i:s')
    ];
});