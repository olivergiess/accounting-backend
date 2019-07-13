<?php

namespace Tests\Unit\Resources;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\Models\Ledger;
use App\Ledger\Http\Resources\LedgerResource;

class LedgerResourceResolveTest extends TestCase
{
	use DatabaseMigrations;

    protected $ledger;
    protected $resource;

    public function additionalSetUp()
	{
		$this->resource = $this->app->build(LedgerResource::class);

		$this->ledger = factory(Ledger::class)->create();
	}

	public function testHasType()
	{
		$this->ledger->load('account');

        $resource = $this->resource->make($this->ledger);

		$result = $resource->resolve();

		$this->assertArrayHasKey('type', $result);
	}

	public function testTypeIsString()
	{
		$this->ledger->load('account');

        $resource = $this->resource->make($this->ledger);

		$result = $resource->resolve();

		$this->assertIsString($result['type']);
	}

	public function testTypeIsLedger()
	{
		$this->ledger->load('account');

        $resource = $this->resource->make($this->ledger);

		$result = $resource->resolve();

		$this->assertEquals('ledger', $result['type']);
	}

	public function testHasId()
	{
		$this->ledger->load('account');

        $resource = $this->resource->make($this->ledger);

		$result = $resource->resolve();

		$this->assertArrayHasKey('id', $result);
	}

	public function testIdIsInt()
	{
		$this->ledger->load('account');

        $resource = $this->resource->make($this->ledger);

		$result = $resource->resolve();

		$this->assertIsInt($result['id']);
	}

	public function testAttributesIdIsCorrect()
	{
		$this->ledger->load('account');

        $resource = $this->resource->make($this->ledger);

		$result = $resource->resolve();

		$this->assertEquals($this->ledger->id, $result['id']);
	}

	public function testHasAttributes()
	{
		$this->ledger->load('account');

        $resource = $this->resource->make($this->ledger);

		$result = $resource->resolve();

		$this->assertArrayHasKey('attributes', $result);
	}

	public function testAttributesIsArray()
	{
		$this->ledger->load('account');

        $resource = $this->resource->make($this->ledger);

		$result = $resource->resolve();

		$attributes = $result['attributes'];

		$this->assertIsArray($attributes);
	}

	public function testAttributesHasName()
	{
		$this->ledger->load('account');

        $resource = $this->resource->make($this->ledger);

		$result = $resource->resolve();

		$attributes = $result['attributes'];

		$this->assertArrayHasKey('name', $attributes);
	}

	public function testNameIsString()
	{
		$this->ledger->load('account');

        $resource = $this->resource->make($this->ledger);

		$result = $resource->resolve();

		$attributes = $result['attributes'];

		$this->assertIsString($attributes['name']);
	}

	public function testNameIsCorrect()
	{
		$this->ledger->load('account');

        $resource = $this->resource->make($this->ledger);

		$result = $resource->resolve();

		$attributes = $result['attributes'];

		$this->assertEquals($this->ledger->name, $attributes['name']);
	}

	public function testAttributesHasBalance()
	{
		$this->ledger->load('account');

        $resource = $this->resource->make($this->ledger);

		$result = $resource->resolve();

		$attributes = $result['attributes'];

		$this->assertArrayHasKey('balance', $attributes);
	}

	public function testBalanceIsInt()
	{
		$this->ledger->load('account');

        $resource = $this->resource->make($this->ledger);

		$result = $resource->resolve();

		$attributes = $result['attributes'];

		$this->assertTrue($attributes['balance'] == 0);
	}

	public function testBalanceIsCorrect()
	{
		$this->ledger->load('account');

        $resource = $this->resource->make($this->ledger);

		$result = $resource->resolve();

		$attributes = $result['attributes'];

		$this->assertEquals($this->ledger->balance, $attributes['balance']);
	}

	public function testAttributesHasAccountId()
	{
		$this->ledger->load('account');

        $resource = $this->resource->make($this->ledger);

		$result = $resource->resolve();

		$attributes = $result['attributes'];

		$this->assertArrayHasKey('account_id', $attributes);
	}

	public function testAccountIdIsInt()
	{
		$this->ledger->load('account');

        $resource = $this->resource->make($this->ledger);

		$result = $resource->resolve();

		$attributes = $result['attributes'];

		$this->assertIsInt($attributes['account_id']);
	}

	public function testAccountIdIsCorrect()
	{
		$this->ledger->load('account');

        $resource = $this->resource->make($this->ledger);

		$result = $resource->resolve();

		$attributes = $result['attributes'];

		$this->assertEquals($this->ledger->account_id, $attributes['account_id']);
	}
}
