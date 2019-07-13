<?php

namespace Tests\Unit\Resources;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\Models\Transaction;
use App\Transaction\Http\Resources\TransactionResource;
use App\Ledger\Http\Resources\LedgerResource;

class TransactionResourceRelationshipsTest extends TestCase
{
    use DatabaseMigrations;

    protected $transaction;
    protected $resource;

    public function additionalSetUp()
	{
		$this->resource = $this->app->build(TransactionResource::class);

		$this->transaction = factory(Transaction::class)->create();
	}

	public function testNoRelationships()
	{
        $resource = $this->resource->make($this->transaction);

		$result = $resource->resolve();

        $this->assertTrue(!array_key_exists('relationships', $result));
	}

    public function testHasRelationships()
	{
		$this->transaction->load('creditee');

        $resource = $this->resource->make($this->transaction);

		$result = $resource->resolve();

        $this->assertArrayHasKey('relationships', $result);
	}

	public function testRelationshipsIsAnArray()
	{
		$this->transaction->load('creditee');

        $resource = $this->resource->make($this->transaction);

		$result = $resource->resolve();

        $relationships = $result['relationships'];

        $this->assertIsArray($relationships);
	}

	public function testRelationshipsHasCreditee()
	{
		$this->transaction->load('creditee');

        $resource = $this->resource->make($this->transaction);

		$result = $resource->resolve();

        $relationships = $result['relationships'];

        $this->assertArrayHasKey('creditee', $relationships);
	}

	public function testCrediteeIsALedgerResourceObject()
	{
		$this->transaction->load('creditee');

        $resource = $this->resource->make($this->transaction);

		$result = $resource->resolve();

        $relationships = $result['relationships'];

        $transactions = $relationships['creditee'];

        $this->assertInstanceOf(LedgerResource::class, $transactions);
	}

	public function testRelationshipsHasDebitee()
	{
		$this->transaction->load('debitee');

        $resource = $this->resource->make($this->transaction);

		$result = $resource->resolve();

        $relationships = $result['relationships'];

        $this->assertArrayHasKey('debitee', $relationships);
	}

	public function testDebiteeIsALedgerResourceObject()
	{
		$this->transaction->load('debitee');

        $resource = $this->resource->make($this->transaction);

		$result = $resource->resolve();

        $relationships = $result['relationships'];

        $transactions = $relationships['debitee'];

        $this->assertInstanceOf(LedgerResource::class, $transactions);
	}
}
