<?php

namespace Tests\Feature\Account;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\User;
use App\Models\Account;
use Laravel\Passport\Passport;

class AccountShowSuccessfulTest extends TestCase
{
	use DatabaseMigrations;

	protected $name = 'test';

	private function feature()
	{
		$user = factory(User::class)->create();

		$account = factory(Account::class)->create(['name' => $this->name]);

		Passport::actingAs($user);

		$response = $this->get('/api/accounts/'.$account->id);

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
