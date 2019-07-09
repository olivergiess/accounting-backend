<?php

namespace Tests\Unit\Resources;

use App\Http\Resources\LedgerCollection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Account;
use App\Models\Ledger;
use App\Http\Resources\AccountResource;

class AccountResourceResolveTest extends TestCase
{
    use DatabaseMigrations;

    protected $account;
    protected $resource;

    public function additionalSetUp()
	{
		$this->resource = $this->app->build(AccountResource::class);

		$this->account = factory(Account::class)->create();
	}

    public function testHasType()
    {
		$resource = $this->resource->make($this->account);

		$result = $resource->resolve();

        $this->assertArrayHasKey('type', $result);
    }

    public function testTypeIsString()
    {
        $resource = $this->resource->make($this->account);

		$result = $resource->resolve();

        $this->assertIsString($result['type']);
    }

    public function testTypeIsAccount()
    {
        $resource = $this->resource->make($this->account);

		$result = $resource->resolve();

        $this->assertEquals('account', $result['type']);
    }

    public function testHasId()
    {
        $resource = $this->resource->make($this->account);

		$result = $resource->resolve();

        $this->assertArrayHasKey('id', $result);
    }

    public function testIdIsInt()
    {
        $resource = $this->resource->make($this->account);

		$result = $resource->resolve();

        $this->assertIsInt($result['id']);
    }

    public function testIdIsCorrect()
    {
        $resource = $this->resource->make($this->account);

		$result = $resource->resolve();

        $this->assertEquals($this->account->id, $result['id']);
    }

    public function testHasAttributes()
    {
        $resource = $this->resource->make($this->account);

		$result = $resource->resolve();

        $this->assertArrayHasKey('attributes', $result);
    }

    public function testAttributesIsArray()
    {
        $resource = $this->resource->make($this->account);

		$result = $resource->resolve();

        $attributes = $result['attributes'];

        $this->assertIsArray($attributes);
    }

    public function testAttributesHasName()
    {
        $resource = $this->resource->make($this->account);

		$result = $resource->resolve();

        $attributes = $result['attributes'];

        $this->assertArrayHasKey('name', $attributes);
    }

    public function testNameIsString()
    {
        $resource = $this->resource->make($this->account);

		$result = $resource->resolve();

        $attributes = $result['attributes'];

        $this->assertIsString($attributes['name']);
    }

    public function testNameIsCorrect()
    {
        $resource = $this->resource->make($this->account);

		$result = $resource->resolve();

        $attributes = $result['attributes'];

        $this->assertEquals($this->account->name, $attributes['name']);
    }

}
