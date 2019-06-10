<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = factory(\App\Models\User::class)->create([
            'email' => 'test@test.com',
			'password' => Hash::make('password'),
        ]);

        $account = factory(\App\Models\Account::class)->create([
            'user_id' => $user->id,
        ]);

        $ledger = factory(\App\Models\Ledger::class, 2)->create([
            'account_id' => $account->id,
        ]);
    }
}
