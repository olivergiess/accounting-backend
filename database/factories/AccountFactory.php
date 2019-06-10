<?php

$factory->define(App\Models\Account::class, function (Faker\Generator $faker) {
    return [
		'name'    => $faker->word,
		'user_id' => factory(App\Models\User::class)->create()->id,
	];
});
