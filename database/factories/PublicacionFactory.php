<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Publicacion;
use Faker\Generator as Faker;

$factory->define(Publicacion::class, function (Faker $faker) {
    return [
        'user_id'=>$faker->numberBetween(1,20),
        'titulo'=>$faker->word(),
        'cuerpo'=>$faker->word(),
        'imagen'=>""
    ];
});
