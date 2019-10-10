<?php

namespace Tests\Unit\Resources;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\Models\Transaction;
use App\Components\Transaction\Http\Resources\TransactionResource;

class TransactionResourceResolveTest extends TestCase
{
	use DatabaseMigrations;

    protected $transaction;
    protected $resource;

    public function additionalSetUp()
	{
		$this->resource = $this->app->build(TransactionResource::class);

		$this->transaction = factory(Transaction::class)->create();
	}

	public function testHasType()
	{
		$this->transaction->load('creditee');

        $resource = $this->resource->make($this->transaction);

		$result = $resource->resolve();

		$this->assertArrayHasKey('type', $result);
	}

	public function testTypeIsString()
	{
		$this->transaction->load('creditee');

        $resource = $this->resource->make($this->transaction);

		$result = $resource->resolve();

		$this->assertIsString($result['type']);
	}

	public function testTypeIsTransaction()
	{
		$this->transaction->load('creditee');

        $resource = $this->resource->make($this->transaction);

		$result = $resource->resolve();

		$this->assertEquals('transaction', $result['type']);
	}

	public function testHasId()
	{
		$this->transaction->load('creditee');

        $resource = $this->resource->make($this->transaction);

		$result = $resource->resolve();

		$this->assertArrayHasKey('id', $result);
	}

	public function testIdIsInt()
	{
		$this->transaction->load('creditee');

        $resource = $this->resource->make($this->transaction);

		$result = $resource->resolve();

		$this->assertIsInt($result['id']);
	}

	public function testIdIsCorrect()
	{
		$this->transaction->load('creditee');

        $resource = $this->resource->make($this->transaction);

		$result = $resource->resolve();

		$this->assertEquals($this->transaction->id, $result['id']);
	}

	public function testHasAttributes()
	{
		$this->transaction->load('creditee');

        $resource = $this->resource->make($this->transaction);

		$result = $resource->resolve();

		$this->assertArrayHasKey('attributes', $result);
	}

	public function testAttributesIsArray()
	{
		$this->transaction->load('creditee');

        $resource = $this->resource->make($this->transaction);

		$result = $resource->resolve();

		$attributes = $result['attributes'];

		$this->assertIsArray($attributes);
	}

	public function testAttributesHasAmount()
	{
		$this->transaction->load('creditee');

        $resource = $this->resource->make($this->transaction);

		$result = $resource->resolve();

		$attributes = $result['attributes'];

		$this->assertArrayHasKey('amount', $attributes);
	}

	public function tesAmountIsInt()
	{
		$this->transaction->load('creditee');

        $resource = $this->resource->make($this->transaction);

		$result = $resource->resolve();

		$attributes = $result['attributes'];

		$this->assertIsInt($attributes['amount']);
	}

	public function testAmountIsCorrect()
	{
		$this->transaction->load('creditee');

        $resource = $this->resource->make($this->transaction);

		$result = $resource->resolve();

		$attributes = $result['attributes'];

		$this->assertEquals($this->transaction->amount, $attributes['amount']);
	}

	public function testAttributesHasCreditLedgerId()
	{
		$this->transaction->load('creditee');

        $resource = $this->resource->make($this->transaction);

		$result = $resource->resolve();

		$attributes = $result['attributes'];

		$this->assertArrayHasKey('credit_ledger_id', $attributes);
	}

	public function testCreditLedgerIdIsInt()
	{
		$this->transaction->load('creditee');

        $resource = $this->resource->make($this->transaction);

		$result = $resource->resolve();

		$attributes = $result['attributes'];

		$this->assertIsInt($attributes['credit_ledger_id']);
	}

	public function testCreditLedgerIdIsCorrect()
	{
		$this->transaction->load('creditee');

        $resource = $this->resource->make($this->transaction);

		$result = $resource->resolve();

		$attributes = $result['attributes'];

		$this->assertEquals($this->transaction->credit_ledger_id, $attributes['credit_ledger_id']);
	}

	public function testAttributesHasDebitLedgerId()
	{
		$this->transaction->load('creditee');

        $resource = $this->resource->make($this->transaction);

		$result = $resource->resolve();

		$attributes = $result['attributes'];

		$this->assertArrayHasKey('debit_ledger_id', $attributes);
	}

	public function testDebitLedgerIdIsInt()
	{
		$this->transaction->load('creditee');

        $resource = $this->resource->make($this->transaction);

		$result = $resource->resolve();

		$attributes = $result['attributes'];

		$this->assertIsInt($attributes['debit_ledger_id']);
	}

	public function testDebitLedgerIdIsCorrect()
	{
		$this->transaction->load('creditee');

        $resource = $this->resource->make($this->transaction);

		$result = $resource->resolve();

		$attributes = $result['attributes'];

		$this->assertEquals($this->transaction->debit_ledger_id, $attributes['debit_ledger_id']);
	}
}
