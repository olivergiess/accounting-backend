<?php

namespace Tests\Unit\Resources;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\Models\Ledger;
use App\Ledger\Http\Resources\LedgerResource;
use App\Account\Http\Resources\AccountResource;
use App\Transaction\Http\Resources\TransactionCollection;

class LedgerResourceRelationshipsTest extends TestCase
{
    use DatabaseMigrations;

    protected $ledger;
    protected $resource;

    public function additionalSetUp()
	{
		$this->resource = $this->app->build(LedgerResource::class);

		$this->ledger = factory(Ledger::class)->create();
	}

	public function testNoRelationships()
	{
        $resource = $this->resource->make($this->ledger);

		$result = $resource->resolve();

        $this->assertTrue(!array_key_exists('relationships', $result));
	}

    public function testHasRelationships()
	{
		$this->ledger->load('account');

        $resource = $this->resource->make($this->ledger);

		$result = $resource->resolve();

        $this->assertArrayHasKey('relationships', $result);
	}

	public function testRelationshipsIsAnArray()
	{
		$this->ledger->load('account');

        $resource = $this->resource->make($this->ledger);

		$result = $resource->resolve();

        $relationships = $result['relationships'];

        $this->assertIsArray($relationships);
	}

	public function testRelationshipsHasAccount()
	{
		$this->ledger->load('account');

        $resource = $this->resource->make($this->ledger);

		$result = $resource->resolve();

        $relationships = $result['relationships'];

        $this->assertArrayHasKey('account', $relationships);
	}

	public function testAccountIsAnAccountResourceObject()
	{
		$this->ledger->load('account');

        $resource = $this->resource->make($this->ledger);

		$result = $resource->resolve();

        $relationships = $result['relationships'];

        $ledgers = $relationships['account'];

        $this->assertInstanceOf(AccountResource::class, $ledgers);
	}

	public function testRelationshipsHasCreditors()
	{
		$this->ledger->load('creditors');

        $resource = $this->resource->make($this->ledger);

		$result = $resource->resolve();

        $relationships = $result['relationships'];

        $this->assertArrayHasKey('creditors', $relationships);
	}

	public function testCreditorsIsATransactionCollectionObject()
	{
		$this->ledger->load('creditors');

        $resource = $this->resource->make($this->ledger);

		$result = $resource->resolve();

        $relationships = $result['relationships'];

        $ledgers = $relationships['creditors'];

        $this->assertInstanceOf(TransactionCollection::class, $ledgers);
	}

	public function testRelationshipsHasDebitors()
	{
		$this->ledger->load('debitors');

        $resource = $this->resource->make($this->ledger);

		$result = $resource->resolve();

        $relationships = $result['relationships'];

        $this->assertArrayHasKey('debitors', $relationships);
	}

	public function testDebitorsIsATransactionCollectionObject()
	{
		$this->ledger->load('debitors');

        $resource = $this->resource->make($this->ledger);

		$result = $resource->resolve();

        $relationships = $result['relationships'];

        $ledgers = $relationships['debitors'];

        $this->assertInstanceOf(TransactionCollection::class, $ledgers);
	}
}
