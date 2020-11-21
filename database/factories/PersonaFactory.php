<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Persona;
use Faker\Generator as Faker;

$factory->define(Persona::class, function (Faker $faker) {
    return [
        'nombre'=>$faker->word(),
        'apellidoPaterno'=>$faker->lastName(),
        'apellidoMaterno'=>$faker->lastName(),
        'edad'=>$faker->numberBetween(5,85),
        'sexo'=>$faker->randomElement(['Masculino','Femenino'])
    ];
});
