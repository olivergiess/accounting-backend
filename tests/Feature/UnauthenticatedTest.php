<?php

namespace Tests\Feature\Account;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\Models\Account;

class UnauthenticatedTest extends TestCase
{
	use DatabaseMigrations;

	private function feature()
	{
		$account = factory(Account::class)->create();

		// Endpoint used should be arbitrary.
		$response = $this->get('/api/accounts/'.$account->id);

		return $response;
	}

	private function errors()
	{
		$response = $this->feature();

		$content = $response->getContent();

		$json = json_decode($content);

        $errors = $json->errors;

        return $errors;
	}

	public function testStatusCodeIs401()
	{
		$response = $this->feature();

		$this->assertEquals(401, $response->getStatusCode());
	}

	public function testContentIsJson()
	{
		$response = $this->feature();

        $this->assertJson($response->getContent());
	}

	public function testResponseHasErrors()
	{
		$response = $this->feature();

		$content = $response->getContent();

		$json = json_decode($content);

		$this->assertObjectHasAttribute('errors', $json);
	}

	public function testErrorsHasMessage()
	{
		$errors = $this->errors();

		$this->assertObjectHasAttribute('message', $errors);
	}

	public function testMessageIsString()
	{
		$errors = $this->errors();

		$this->assertIsString($errors->message);
	}

	public function testMessageIsCorrect()
	{
		$errors = $this->errors();

		$this->assertEquals('Unauthorised', $errors->message);
	}

	public function testErrorsHasStatus()
	{
		$errors = $this->errors();

		$this->assertObjectHasAttribute('status', $errors);
	}

	public function testStatusIsInt()
	{
		$errors = $this->errors();

		$this->assertIsInt($errors->status);
	}

	public function testStatusIsCorrect()
	{
		$errors = $this->errors();

		$this->assertEquals(401, $errors->status);
	}
}
