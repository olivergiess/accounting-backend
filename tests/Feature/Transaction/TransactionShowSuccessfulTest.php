<?php

namespace Tests\Feature\Account;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\User;
use App\Models\Account;
use App\Models\Ledger;
use Laravel\Passport\Passport;

class TransactionShowSuccessfulTest extends TestCase
{
    use DatabaseMigrations;

    protected $amount = 100;
    protected $creditee;
    protected $debitee;

    private function feature()
    {
        $user = factory(User::class)->create();

		Passport::actingAs($user);

        $account = factory(Account::class)->create();

        list($this->creditee, $this->debitee) = factory(Ledger::class, 2)->create(['account_id' => $account]);

        $transaction = $this->post('/api/transactions', [
        	'amount' => $this->amount,
        	'credit_ledger_id' => $this->creditee->id,
			'debit_ledger_id' => $this->debitee->id
	    ]);

        $content = $transaction->getContent();

        $json = json_decode($content);

        $data = $json->data;

		$response = $this->get('/api/transactions/'.$data->id);

		$this->creditee->refresh();
		$this->debitee->refresh();

        return $response;
    }

    private function data()
    {
        $response = $this->feature();

        $content = $response->getContent();

        $json = json_decode($content);

        $data = $json->data;

        return $data;
    }

    public function testResponseCodeIs200()
    {
        $response = $this->feature();

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testContentIsJson()
    {
        $response = $this->feature();

        $this->assertJson($response->getContent());
    }

    public function testJsonHasData()
    {
        $response = $this->feature();

        $content = $response->getContent();

        $json = json_decode($content);

        $this->assertObjectHasAttribute('data', $json);
    }

    public function testDataHasType()
    {
        $data = $this->data();

        $this->assertObjectHasAttribute('type', $data);
    }

    public function testTypeIsString()
    {
        $data = $this->data();

        $this->assertIsString($data->type);
    }

    public function testTypeIsAccount()
    {
        $data = $this->data();

        $this->assertEquals('transaction', $data->type);
    }

    public function testDataHasId()
    {
        $data = $this->data();

        $this->assertObjectHasAttribute('id', $data);
    }

    public function testIdIsInt()
    {
        $data = $this->data();

        $this->assertIsInt($data->id);
    }

    public function testDataHasAttributes()
    {
        $data = $this->data();

        $this->assertObjectHasAttribute('attributes', $data);
    }

    public function testAttributesHasAmount()
    {
        $data = $this->data();

        $attributes = $data->attributes;

        $this->assertObjectHasAttribute('amount', $attributes);
    }

    public function testAmountIsCorrect()
    {
        $data = $this->data();

        $attributes = $data->attributes;

        $amount = $attributes->amount;

        $this->assertEquals($this->amount, $amount);
    }

    public function testAttributesHasCreditLedgerId()
    {
        $data = $this->data();

        $attributes = $data->attributes;

        $this->assertObjectHasAttribute('credit_ledger_id', $attributes);
    }

    public function testCreditLedgerIdsCorrect()
    {
        $data = $this->data();

        $attributes = $data->attributes;

        $credit_ledger_id = $attributes->credit_ledger_id;

        $this->assertEquals($this->creditee->id, $credit_ledger_id);
    }

	public function testCrediteeBalanceHasBeenUpdatedCorrectly()
	{
		$this->feature();

		$this->assertEquals($this->amount, $this->creditee->balance);
	}

    public function testAttributesHasDebitLedgerId()
    {
        $data = $this->data();

        $attributes = $data->attributes;

        $this->assertObjectHasAttribute('debit_ledger_id', $attributes);
    }

    public function testDebitLedgerIdsCorrect()
    {
        $data = $this->data();

        $attributes = $data->attributes;

        $debit_ledger_id = $attributes->debit_ledger_id;

        $this->assertEquals($this->debitee->id, $debit_ledger_id);
    }

	public function testDebiteeBalanceHasBeenUpdatedCorrectly()
	{
		$this->feature();

		$this->assertEquals((-1 * $this->amount), $this->debitee->balance);
	}
}
