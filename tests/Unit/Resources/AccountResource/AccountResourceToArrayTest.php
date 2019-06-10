<?php

namespace Tests\Unit\Resources;

use App\Http\Resources\LedgerCollection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Account;
use App\Models\Ledger;
use App\Http\Resources\AccountResource;

class AccountResourceToArrayTest extends TestCase
{
    use DatabaseMigrations;

    public function testHasType()
    {
        $account = factory(Account::class)->create();

        $resource = new AccountResource($account);

        $data = $resource->toArray();

        $this->assertArrayHasKey('type', $data);
    }

    public function testTypeIsString()
    {
        $account = factory(Account::class)->create();

        $resource = new AccountResource($account);

        $data = $resource->toArray();

        $this->assertIsString($data['type']);
    }

    public function testTypeIsAccount()
    {
        $account = factory(Account::class)->create();

        $resource = new AccountResource($account);

        $data = $resource->toArray();

        $this->assertEquals('account', $data['type']);
    }

    public function testHasId()
    {
        $account = factory(Account::class)->create();

        $resource = new AccountResource($account);

        $data = $resource->toArray();

        $this->assertArrayHasKey('id', $data);
    }

    public function testIdIsInt()
    {
        $account = factory(Account::class)->create();

        $resource = new AccountResource($account);

        $data = $resource->toArray();

        $this->assertIsInt($data['id']);
    }

    public function testIdIsCorrect()
    {
        $account = factory(Account::class)->create();

        $resource = new AccountResource($account);

        $data = $resource->toArray();

        $this->assertEquals($account->id, $data['id']);
    }

    public function testHasAttributes()
    {
        $account = factory(Account::class)->create();

        $resource = new AccountResource($account);

        $data = $resource->toArray();

        $this->assertArrayHasKey('attributes', $data);
    }

    public function testAttributesIsArray()
    {
        $account = factory(Account::class)->create();

        $resource = new AccountResource($account);

        $data = $resource->toArray();

        $attributes = $data['attributes'];

        $this->assertIsArray($attributes);
    }

    public function testAttributesHasName()
    {
        $account = factory(Account::class)->create();

        $resource = new AccountResource($account);

        $data = $resource->toArray();

        $attributes = $data['attributes'];

        $this->assertArrayHasKey('name', $attributes);
    }

    public function testNameIsString()
    {
        $account = factory(Account::class)->create();

        $resource = new AccountResource($account);

        $data = $resource->toArray();

        $attributes = $data['attributes'];

        $this->assertIsString($attributes['name']);
    }

    public function testNameIsCorrect()
    {
        $account = factory(Account::class)->create();

        $resource = new AccountResource($account);

        $data = $resource->toArray();

        $attributes = $data['attributes'];

        $this->assertEquals($account->name, $attributes['name']);
    }

    public function testHasRelationships()
	{
		$account = factory(Account::class)->create();

        $resource = new AccountResource($account);

        $result = $resource->toArray();

        $this->assertArrayHasKey('relationships', $result);
	}

	public function testRelationshipsIsArray()
	{
		$account = factory(Account::class)->create();

        $resource = new AccountResource($account);

        $result = $resource->toArray();

        $relationships = $result['relationships'];

        $this->assertIsArray($relationships);
	}

	public function testRelationshipsHasLedgers()
	{
		$account = factory(Account::class)->create();

        $resource = new AccountResource($account);

        $result = $resource->toArray();

        $relationships = $result['relationships'];

        $this->assertArrayHasKey('ledgers', $relationships);
	}

	public function testLedgersIsLedgerCollectionObject()
	{
		$account = factory(Account::class)->create();

		factory(Ledger::class, 10)->create(['account_id' => $account->id], 2);

		$resource = new AccountResource($account);

        $result = $resource->toArray();

        $relationships = $result['relationships'];

        $ledgers = $relationships['ledgers'];

        $this->assertInstanceOf(LedgerCollection::class, $ledgers);
	}
}
