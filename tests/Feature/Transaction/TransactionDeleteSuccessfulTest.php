<?php

namespace Tests\Feature\Account;

use App\Models\Transaction;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\User;
use App\Models\Account;
use App\Models\Ledger;
use Laravel\Passport\Passport;
use App\Libraries\Ledger as LedgerLibrary;

class TransactionDeleteSuccessfulTest extends TestCase
{
    use DatabaseMigrations;

    protected $amount = 100;
    protected $creditee;
    protected $debitee;

    private function feature($auth = TRUE)
    {
        $user = factory(User::class)->create();

        if($auth)
        	Passport::actingAs($user);

        $account = factory(Account::class)->create(['user_id' => $user->id]);

        list($this->creditee, $this->debitee) = factory(Ledger::class, 2)->create(['account_id' => $account]);

        $transaction = factory(Transaction::class)->create([
        	'amount' => $this->amount,
        	'credit_ledger_id' => $this->creditee->id,
			'debit_ledger_id' => $this->debitee->id
														   ]);

        $ledgerLibrary = $this->app->build(LedgerLibrary::class);
        $ledgerLibrary->transfer($transaction->amount, $transaction->debit_ledger_id, $transaction->credit_ledger_id);

		$response = $this->delete('/api/transactions/'.$transaction->id);

        return $response;
    }

	public function testMustBeAuthenticated()
	{
		$response = $this->feature(FALSE);

        $this->assertEquals(401, $response->getStatusCode());
	}

    public function testResponseCodeIs204()
    {
        $response = $this->feature();

        $this->assertEquals(204, $response->getStatusCode());
    }

    public function testCrediteeBalanceHasBeenUpdatedCorrectly()
	{
		$this->feature();

		$this->assertEquals(0, $this->creditee->balance);
	}

	public function testDebiteeBalanceHasBeenUpdatedCorrectly()
	{
		$this->feature();

		$this->assertEquals(0, $this->debitee->balance);
	}
}
