<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'title'     => $this->Faker->sentence(),
        'tags'      => 'php, laravel, dom, api',
        'company'   => $this->Faker->company(),
        'email'     => $this->Faker->companyEmail(),
        'website'   => $this->Faker->url(),
        'location'     => $this->Faker->city(),
        'desc'     => $this->Faker->paragraph(5),
    ];
});
