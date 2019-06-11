<?php

namespace Tests\Feature\Ledger;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\User;
use Laravel\Passport\Passport;
use App\Models\Account;

class LedgerCreateSuccessfulTest extends TestCase
{
    use DatabaseMigrations;

    protected $name = 'test';
    protected $account;

    private function feature()
    {
        $user = factory(User::class)->create();

        Passport::actingAs($user);

        $this->account = factory(Account::class)->create();

        $payload = [
            'name' => $this->name,
            'account_id' => $this->account->id,
        ];

        $response = $this->post('/api/ledgers', $payload);

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

    public function testTypeIsLedger()
    {
        $data = $this->data();

        $this->assertEquals('ledger', $data->type);
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

    public function testNameIsCorrect()
    {
        $data = $this->data();

        $attributes = $data->attributes;

        $name = $attributes->name;

        $this->assertEquals($this->name, $name);
    }


    public function testHasAccountId()
    {
        $data = $this->data();

        $attributes = $data->attributes;

        $this->assertObjectHasAttribute('account_id', $attributes);
    }

    public function testAccountIdIsCorrect()
    {
        $data = $this->data();

        $attributes = $data->attributes;

        $account_id = $attributes->account_id;

        $this->assertEquals($this->account->id, $account_id);
    }

}
