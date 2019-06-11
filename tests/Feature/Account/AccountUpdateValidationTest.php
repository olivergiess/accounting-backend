<?php

namespace Tests\Feature\Account;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\User;
use Laravel\Passport\Passport;
use App\Models\Account;

class AccountUpdateValidationTest extends TestCase
{
	use DatabaseMigrations;

	protected $newName = 1;

	private function feature()
	{
		$user = factory(User::class)->create();

		Passport::actingAs($user);

		$account = factory(Account::class)->create([
			'name' => 'one',
			'user_id' => $user->id
		]);

		$payload = [
			'name'    => $this->newName,
		];

		$response = $this->put('/api/accounts/'.$account->id, $payload);

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

	public function testResponseCodeIs422()
	{
		$response = $this->feature();

		$this->assertEquals(422, $response->getStatusCode());
	}

	public function testContentIsJson()
	{
		$response = $this->feature();

		$this->assertJson($response->getContent());
	}

	public function testJsonHasErrors()
	{
		$response = $this->feature();

		$content = $response->getContent();

		$json = json_decode($content);

		$this->assertObjectHasAttribute('errors', $json);
	}

    public function testErrorsHasName()
	{
		$errors = $this->errors();

        $this->assertObjectHasAttribute('name', $errors);
	}

	public function testNameIsRequired()
	{
		$this->newName = NULL;

		$errors = $this->errors();

        $this->assertContains('The name field is required.', $errors->name);
	}

	public function testNameMustBeAString()
	{
		$errors = $this->errors(['name' => 1]);

        $this->assertContains('The name must be a string.', $errors->name);
	}
}
