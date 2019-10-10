<?php

namespace Tests\Unit\Resources;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\Models\Ledger;
use App\Components\Ledger\Http\Resources\LedgerResource;
use App\Components\Ledger\Http\Resources\LedgerCollection;
use Illuminate\Support\Collection;

class LedgerCollectionTest extends TestCase
{
	use DatabaseMigrations;

	protected $ledger;
	protected $collection;

	public function additionalSetUp()
	{
		$this->ledger = factory(Ledger::class, 1)->create();

        $this->collection = new LedgerCollection($this->ledger);
	}

    public function testCanBeInstantiated()
    {
        $this->assertInstanceOf(LedgerCollection::class, $this->collection);
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

    public function testResolveDataCollectionIsLedgerResources()
    {
        $result = $this->collection->resolve();

        $data = $result['data'];

        $first = $data->first();

        $this->assertInstanceOf(LedgerResource::class, $first);
    }
}
