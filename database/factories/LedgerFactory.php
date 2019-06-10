<?php

$factory->define(App\Models\Ledger::class, function (Faker\Generator $faker) {
    return [
        'name'    => $faker->word,
        'account_id' => factory(App\Models\Account::class)->create()->id,
	];
});
