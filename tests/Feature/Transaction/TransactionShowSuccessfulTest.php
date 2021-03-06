<?php

namespace Tests\Feature\Account;

use App\Models\Transaction;
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
			'debit_ledger_id' => $this->debitee->id,
		]);

		$response = $this->get('/api/transactions/'.$transaction->id);

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

	public function testMustBeAuthenticated()
	{
		$response = $this->feature(FALSE);

        $this->assertEquals(401, $response->getStatusCode(), 'Failed asserting that user is authenticated.');
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
}
