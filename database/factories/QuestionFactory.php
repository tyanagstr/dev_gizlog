<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Question::class, function (Faker $faker) {
    return [
        'user_id' => random_int(1, 3),
        'tag_category_id' => random_int(1, 4),
        'title' => $faker->sentence(),
        'content' => $faker->text()
    ];
});
