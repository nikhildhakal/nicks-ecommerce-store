<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {

    return [

        'name' => $faker->sentence(3),

        'image' => 'uploads/products/book.png',

        'description' => $faker->paragraph(4),

        'price' => $faker->numberBetween(100, 10000)

    ];

});
