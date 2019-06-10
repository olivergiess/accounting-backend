<?php

namespace Tests\Unit\Resources;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Ledger;
use App\Http\Resources\LedgerResource;

class LedgerResourceToArrayTest extends TestCase
{
	use DatabaseMigrations;

	public function testHasType()
	{
		$ledger = factory(Ledger::class)->create();

		$resource = new LedgerResource($ledger);

		$data = $resource->toArray();

		$this->assertArrayHasKey('type', $data);
	}

	public function testTypeIsString()
	{
		$ledger = factory(Ledger::class)->create();

		$resource = new LedgerResource($ledger);

		$data = $resource->toArray();

		$this->assertIsString($data['type']);
	}

	public function testTypeIsLedger()
	{
		$ledger = factory(Ledger::class)->create();

		$resource = new LedgerResource($ledger);

		$data = $resource->toArray();

		$this->assertEquals('ledger', $data['type']);
	}

	public function testHasId()
	{
		$ledger = factory(Ledger::class)->create();

		$resource = new LedgerResource($ledger);

		$data = $resource->toArray();

		$this->assertArrayHasKey('id', $data);
	}

	public function testIdIsInt()
	{
		$ledger = factory(Ledger::class)->create();

		$resource = new LedgerResource($ledger);

		$data = $resource->toArray();

		$this->assertIsInt($data['id']);
	}

	public function testAttributesIdIsCorrect()
	{
		$ledger = factory(Ledger::class)->create();

		$resource = new LedgerResource($ledger);

		$data = $resource->toArray();

		$this->assertEquals($ledger->id, $data['id']);
	}

	public function testHasAttributes()
	{
		$ledger = factory(Ledger::class)->create();

		$resource = new LedgerResource($ledger);

		$data = $resource->toArray();

		$this->assertArrayHasKey('attributes', $data);
	}

	public function testAttributesIsArray()
	{
		$ledger = factory(Ledger::class)->create();

		$resource = new LedgerResource($ledger);

		$data = $resource->toArray();

		$attributes = $data['attributes'];

		$this->assertIsArray($attributes);
	}

	public function testAttributesHasName()
	{
		$ledger = factory(Ledger::class)->create();

		$resource = new LedgerResource($ledger);

		$data = $resource->toArray();

		$attributes = $data['attributes'];

		$this->assertArrayHasKey('name', $attributes);
	}

	public function testNameIsString()
	{
		$ledger = factory(Ledger::class)->create();

		$resource = new LedgerResource($ledger);

		$data = $resource->toArray();

		$attributes = $data['attributes'];

		$this->assertIsString($attributes['name']);
	}

	public function testNameIsCorrect()
	{
		$ledger = factory(Ledger::class)->create();

		$resource = new LedgerResource($ledger);

		$data = $resource->toArray();

		$attributes = $data['attributes'];

		$this->assertEquals($ledger->name, $attributes['name']);
	}

	public function testAttributesHasBalance()
	{
		$ledger = factory(Ledger::class)->create();

		$ledger->refresh();

		$resource = new LedgerResource($ledger);

		$data = $resource->toArray();

		$attributes = $data['attributes'];

		$this->assertArrayHasKey('balance', $attributes);
	}

	public function testBalanceIsInt()
	{
		$ledger = factory(Ledger::class)->create();

		$ledger->refresh();

		$resource = new LedgerResource($ledger);

		$data = $resource->toArray();

		$attributes = $data['attributes'];

		$this->assertTrue($attributes['balance'] == 0);
	}

	public function testBalanceIsCorrect()
	{
		$ledger = factory(Ledger::class)->create();

		$ledger->refresh();

		$resource = new LedgerResource($ledger);

		$data = $resource->toArray();

		$attributes = $data['attributes'];

		$this->assertEquals($ledger->balance, $attributes['balance']);
	}

	public function testAttributesHasAccountId()
	{
		$ledger = factory(Ledger::class)->create();

		$resource = new LedgerResource($ledger);

		$data = $resource->toArray();

		$attributes = $data['attributes'];

		$this->assertArrayHasKey('account_id', $attributes);
	}

	public function testAccountIdIsInt()
	{
		$ledger = factory(Ledger::class)->create();

		$resource = new LedgerResource($ledger);

		$data = $resource->toArray();

		$attributes = $data['attributes'];

		$this->assertIsInt($attributes['account_id']);
	}

	public function testAccountIdIsCorrect()
	{
		$ledger = factory(Ledger::class)->create();

		$resource = new LedgerResource($ledger);

		$data = $resource->toArray();

		$attributes = $data['attributes'];

		$this->assertEquals($ledger->account_id, $attributes['account_id']);
	}
}
