<?php

$factory->define(App\Models\Transaction::class, function (Faker\Generator $faker) {
    $account = factory(App\Models\Account::class)->create();

    $credit_ledger = factory(App\Models\Ledger::class)->create([
        'account_id' => $account->id
    ]);

    $debit_ledger = factory(App\Models\Ledger::class)->create([
        'account_id' => $account->id
    ]);

    return [
        'amount' => $faker->numberBetween(1),
        'credit_ledger_id' => $credit_ledger->id,
        'debit_ledger_id' => $debit_ledger->id,
    ];
});
