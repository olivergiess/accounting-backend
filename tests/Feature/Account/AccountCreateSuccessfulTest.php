<?php

namespace Tests\Feature\Account;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\User;
use App\Models\Account;
use Laravel\Passport\Passport;

class AccountCreateSuccessfulTest extends TestCase
{
	use DatabaseMigrations;

	protected $user;
	protected $name = 'test';

	private function feature($auth = TRUE)
	{
		$this->user = factory(User::class)->create();

		if($auth)
			Passport::actingAs($this->user);

		$payload = [
			'name'    => $this->name,
		];

		$response = $this->post('/api/accounts', $payload);

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

	public function testBelongsToAuthenticatedUser()
	{
		$data = $this->data();

		$account = Account::findOrFail($data->id);

        $this->assertEquals($this->user->id, $account->user_id);
	}

	public function testResponseCodeIs201()
	{
		$response = $this->feature();

        $this->assertEquals(201, $response->getStatusCode());
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

	public function testDataHasAttributes()
	{
		$data = $this->data();

        $this->assertObjectHasAttribute('attributes', $data);
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
