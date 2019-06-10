<?php

namespace Tests\Feature\Account;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\User;
use App\Models\Account;
use App\Models\Ledger;
use Laravel\Passport\Passport;

class TransactionDeleteSuccessfulTest extends TestCase
{
    use DatabaseMigrations;

    protected $amount = 100;
    protected $creditee;
    protected $debitee;

    private function feature()
    {
        $user = factory(User::class)->create();

        Passport::actingAs($user);

        $account = factory(Account::class)->create(['user_id' => $user->id]);

        list($this->creditee, $this->debitee) = factory(Ledger::class, 2)->create(['account_id' => $account]);

        $transaction = $this->post('/api/transactions', [
        	'amount' => $this->amount,
        	'credit_ledger_id' => $this->creditee->id,
			'debit_ledger_id' => $this->debitee->id
	    ]);

        $content = $transaction->getContent();

        $json = json_decode($content);

        $data = $json->data;

		$response = $this->delete('/api/transactions/'.$data->id);

		$this->creditee->refresh();
		$this->debitee->refresh();

        return $response;
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
