<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Comment::class, function (Faker $faker) {
    return [
        'user_id' => random_int(1, 3),
        'question_id' => random_int(1, 4),
        'comment' => $faker->text()
    ];
});
