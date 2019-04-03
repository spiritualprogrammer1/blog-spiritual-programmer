<?php

use Faker\Generator as Faker;

$factory->define(\App\Model\Category::class, function (Faker $faker) {
    $words = $faker->word;
    return [
        'name'=>$words,
        'slug'=>str_slug($words),
    ];
});
