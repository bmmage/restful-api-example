<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $descriptor = [
        'Twin ',
        'Full ',
        'Queen ',
        'King ',
        'California King ',
    ];
    $product = [
        'Mattress',
        'Pillow',
        'Sheets',
        'Mattress Protector',
        'Pillow Case'
    ];
    $productName = $faker->randomElement($descriptor) . $faker->randomElement($product);

    return [
        'name' => $productName,
        'price' => $faker->randomFloat(2, 10, 500),
        'image_url' => $faker->imageUrl(),
        'description' => $faker->sentence(8),
        'thumbnail_url' => $faker->imageUrl(64,48),
    ];
});
