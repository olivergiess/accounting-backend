<?php

namespace Tests\Unit\Resources;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\Models\Transaction;
use App\Transaction\Http\Resources\TransactionCollection;
use App\Transaction\Http\Resources\TransactionResource;
use Illuminate\Support\Collection;

class TransactionCollectionTest extends TestCase
{
	use DatabaseMigrations;

	protected $transaction;
	protected $collection;

	public function additionalSetUp()
	{
		$this->transaction = factory(Transaction::class, 1)->create();

        $this->collection = new TransactionCollection($this->transaction);
	}

	public function testCanBeInstantiated()
    {
        $this->assertInstanceOf(TransactionCollection::class, $this->collection);
    }

    public function testResolveIsArray()
    {
        $result = $this->collection->resolve();

        $this->assertIsArray($result);
    }

    public function testResolveHasData()
    {
        $result = $this->collection->resolve();

        $this->assertArrayHasKey('data', $result);
    }

    public function testResolveDataIsCollection()
    {
        $result = $this->collection->resolve();

        $data = $result['data'];

        $this->assertInstanceOf(Collection::class, $data);
    }

    public function testResolveDataCollectionIsTransactionResources()
    {
        $result = $this->collection->resolve();

        $data = $result['data'];

        $first = $data->first();

        $this->assertInstanceOf(TransactionResource::class, $first);
    }
}
