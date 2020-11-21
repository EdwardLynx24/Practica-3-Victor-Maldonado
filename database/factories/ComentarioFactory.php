<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comentario;
use Faker\Generator as Faker;

$factory->define(Comentario::class, function (Faker $faker) {
    return [
        'user_id'=>$faker->numberBetween(1,20),
        'publicacion_id'=>$faker->numberBetween(1,20),
        'comentario'=>$faker->word()
        
    ];
});
