<?php

namespace Tests\Feature\Account;

use App\Models\Ledger;
use App\Models\Transaction;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\User;
use Laravel\Passport\Passport;
use App\Models\Account;

class AccountShowSuccessfulTest extends TestCase
{
	use DatabaseMigrations;

	protected $name = 'test';

	private function feature($auth = TRUE, $get = '')
	{
		$user = factory(User::class)->create();

		if($auth)
			Passport::actingAs($user);

		$account = factory(Account::class)->create([
			'name' => $this->name,
			'user_id' => $user->id
		]);

		list($creditee, $debitee) = factory(Ledger::class, 2)->create([
			'account_id' => $account->id,
		]);

		$transactions = factory(Transaction::class, 50)->create([
			'credit_ledger_id' => $creditee->id,
			'debit_ledger_id' => $debitee->id,
		]);

		$response = $this->get('/api/accounts/'.$account->id.$get);

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

        $this->assertEquals(401, $response->getStatusCode());
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

        $this->assertEquals('account', $data->type);
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

	public function testAttributesHasName()
	{
		$data = $this->data();

		$attributes = $data->attributes;

        $this->assertObjectHasAttribute('name', $attributes);
	}

	public function testAttributesNameIsCorrect()
	{
		$data = $this->data();

		$attributes = $data->attributes;

		$name = $attributes->name;

        $this->assertEquals($this->name, $name);
	}
}
