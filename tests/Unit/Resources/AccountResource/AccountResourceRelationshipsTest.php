<?php

namespace Tests\Unit\Resources;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\Account\Http\Resources\AccountResource;
use App\Ledger\Http\Resources\LedgerCollection;
use App\Models\Account;

class AccountResourceRelationshipsTest extends TestCase
{
    use DatabaseMigrations;

    protected $account;
    protected $resource;

    public function additionalSetUp()
	{
		$this->resource = $this->app->build(AccountResource::class);

		$this->account = factory(Account::class)->create();
	}

	public function testNoRelationships()
	{
        $resource = $this->resource->make($this->account);

		$result = $resource->resolve();

        $this->assertTrue(!array_key_exists('relationships', $result));
	}

    public function testHasRelationships()
	{
		$this->account->load('ledgers');

        $resource = $this->resource->make($this->account);

		$result = $resource->resolve();

        $this->assertArrayHasKey('relationships', $result);
	}

	public function testRelationshipsIsAnArray()
	{
		$this->account->load('ledgers');

        $resource = $this->resource->make($this->account);

		$result = $resource->resolve();

        $relationships = $result['relationships'];

        $this->assertIsArray($relationships);
	}

	public function testRelationshipsHasLedgers()
	{
		$this->account->load('ledgers');

        $resource = $this->resource->make($this->account);

		$result = $resource->resolve();

        $relationships = $result['relationships'];

        $this->assertArrayHasKey('ledgers', $relationships);
	}

	public function testLedgersIsALedgerCollectionObject()
	{
		$this->account->load('ledgers');

        $resource = $this->resource->make($this->account);

		$result = $resource->resolve();

        $relationships = $result['relationships'];

        $ledgers = $relationships['ledgers'];

        $this->assertInstanceOf(LedgerCollection::class, $ledgers);
	}
}
