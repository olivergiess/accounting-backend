<?php

namespace Tests\Feature\Account;

use App\Models\Ledger;
use App\Models\Transaction;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\User;
use Laravel\Passport\Passport;
use App\Models\Account;

class AccountAllSuccessfulTest extends TestCase
{
	use DatabaseMigrations;

	private function feature($auth = TRUE)
	{
		$user = factory(User::class)->create();

		if($auth)
			Passport::actingAs($user);

		$account = factory(Account::class, 2)->create([
			'user_id' => $user->id
		]);

		$response = $this->get('/api/accounts');

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

	public function testDataIsArray()
	{
		$data = $this->data();

        $this->assertIsArray($data);
	}
}
