<?php

namespace Tests\Feature\Account\Ledger;

use App\Models\Ledger;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\User;
use App\Models\Account;
use Laravel\Passport\Passport;

class LedgerAllSuccessfulTest extends TestCase
{
    use DatabaseMigrations;

    protected $account;

    private function feature($auth = TRUE)
    {
        $user = factory(User::class)->create();

        if($auth)
        	Passport::actingAs($user);

        $this->account = factory(Account::class)->create(['user_id' => $user->id]);

        $ledgers = factory(Ledger::class, 1)->create([
            'account_id' => $this->account->id
        ]);

        $response = $this->get('/api/accounts/'.$this->account->id.'/ledgers');

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

    public function testDataElementHasType()
    {
        $data = $this->data();

        $element = array_shift($data);

        $this->assertObjectHasAttribute('type', $element);
    }

    public function testTypeIsString()
    {
        $data = $this->data();

        $element = array_shift($data);

        $this->assertIsString($element->type);
    }

    public function testTypeIsAccount()
    {
        $data = $this->data();

        $element = array_shift($data);

        $this->assertEquals('ledger', $element->type);
    }

    public function testDataElementHasId()
    {
        $data = $this->data();

        $element = array_shift($data);

        $this->assertObjectHasAttribute('id', $element);
    }

    public function testIdIsInt()
    {
        $data = $this->data();

        $element = array_shift($data);

        $this->assertIsInt($element->id);
    }

    public function testAttributesHasName()
    {
        $data = $this->data();

        $element = array_shift($data);

        $attributes = $element->attributes;

        $this->assertObjectHasAttribute('name', $attributes);
    }

    public function testAttributesHasAccountId()
    {
        $data = $this->data();

        $element = array_shift($data);

        $attributes = $element->attributes;

        $this->assertObjectHasAttribute('account_id', $attributes);
    }

    public function testAccountIdIsCorrect()
    {
        $data = $this->data();

        $element = array_shift($data);

        $attributes = $element->attributes;

        $account_id = $attributes->account_id;

        $this->assertEquals($this->account->id, $account_id);
    }
}
