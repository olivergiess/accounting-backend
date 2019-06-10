<?php

namespace Tests\Unit\Resources;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Transaction;
use App\Http\Resources\TransactionResource;

class TransactionResourceToArrayTest extends TestCase
{
	use DatabaseMigrations;

	public function testHasType()
	{
		$transaction = factory(Transaction::class)->create();

		$resource = new TransactionResource($transaction);

		$data = $resource->toArray();

		$this->assertArrayHasKey('type', $data);
	}

	public function testTypeIsString()
	{
		$transaction = factory(Transaction::class)->create();

		$resource = new TransactionResource($transaction);

		$data = $resource->toArray();

		$this->assertIsString($data['type']);
	}

	public function testTypeIsTransaction()
	{
		$transaction = factory(Transaction::class)->create();

		$resource = new TransactionResource($transaction);

		$data = $resource->toArray();

		$this->assertEquals('transaction', $data['type']);
	}

	public function testHasId()
	{
		$transaction = factory(Transaction::class)->create();

		$resource = new TransactionResource($transaction);

		$data = $resource->toArray();

		$this->assertArrayHasKey('id', $data);
	}

	public function testIdIsInt()
	{
		$transaction = factory(Transaction::class)->create();

		$resource = new TransactionResource($transaction);

		$data = $resource->toArray();

		$this->assertIsInt($data['id']);
	}

	public function testIdIsCorrect()
	{
		$transaction = factory(Transaction::class)->create();

		$resource = new TransactionResource($transaction);

		$data = $resource->toArray();

		$this->assertEquals($transaction->id, $data['id']);
	}

	public function testHasAttributes()
	{
		$transaction = factory(Transaction::class)->create();

		$resource = new TransactionResource($transaction);

		$data = $resource->toArray();

		$this->assertArrayHasKey('attributes', $data);
	}

	public function testAttributesIsArray()
	{
		$transaction = factory(Transaction::class)->create();

		$resource = new TransactionResource($transaction);

		$data = $resource->toArray();

		$attributes = $data['attributes'];

		$this->assertIsArray($attributes);
	}

	public function testAttributesHasAmount()
	{
		$transaction = factory(Transaction::class)->create();

		$resource = new TransactionResource($transaction);

		$data = $resource->toArray();

		$attributes = $data['attributes'];

		$this->assertArrayHasKey('amount', $attributes);
	}

	public function tesAmountIsInt()
	{
		$transaction = factory(Transaction::class)->create();

		$resource = new TransactionResource($transaction);

		$data = $resource->toArray();

		$attributes = $data['attributes'];

		$this->assertIsInt($attributes['amount']);
	}

	public function testAmountIsCorrect()
	{
		$transaction = factory(Transaction::class)->create();

		$resource = new TransactionResource($transaction);

		$data = $resource->toArray();

		$attributes = $data['attributes'];

		$this->assertEquals($transaction->amount, $attributes['amount']);
	}

	public function testAttributesHasCreditLedgerId()
	{
		$transaction = factory(Transaction::class)->create();

		$resource = new TransactionResource($transaction);

		$data = $resource->toArray();

		$attributes = $data['attributes'];

		$this->assertArrayHasKey('credit_ledger_id', $attributes);
	}

	public function testCreditLedgerIdIsInt()
	{
		$transaction = factory(Transaction::class)->create();

		$resource = new TransactionResource($transaction);

		$data = $resource->toArray();

		$attributes = $data['attributes'];

		$this->assertIsInt($attributes['credit_ledger_id']);
	}

	public function testCreditLedgerIdIsCorrect()
	{
		$transaction = factory(Transaction::class)->create();

		$resource = new TransactionResource($transaction);

		$data = $resource->toArray();

		$attributes = $data['attributes'];

		$this->assertEquals($transaction->credit_ledger_id, $attributes['credit_ledger_id']);
	}

	public function testAttributesHasDebitLedgerId()
	{
		$transaction = factory(Transaction::class)->create();

		$resource = new TransactionResource($transaction);

		$data = $resource->toArray();

		$attributes = $data['attributes'];

		$this->assertArrayHasKey('debit_ledger_id', $attributes);
	}

	public function testDebitLedgerIdIsInt()
	{
		$transaction = factory(Transaction::class)->create();

		$resource = new TransactionResource($transaction);

		$data = $resource->toArray();

		$attributes = $data['attributes'];

		$this->assertIsInt($attributes['debit_ledger_id']);
	}

	public function testDebitLedgerIdIsCorrect()
	{
		$transaction = factory(Transaction::class)->create();

		$resource = new TransactionResource($transaction);

		$data = $resource->toArray();

		$attributes = $data['attributes'];

		$this->assertEquals($transaction->debit_ledger_id, $attributes['debit_ledger_id']);
	}
}
