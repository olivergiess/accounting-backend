<?php

namespace Tests\Unit\Resources;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Ledger;
use App\Http\Resources\LedgerCollection;
use Illuminate\Support\Collection;
use App\Http\Resources\LedgerResource;

class LedgerCollectionTest extends TestCase
{
	use DatabaseMigrations;

    public function testCanBeInstantiated()
    {
    	$ledger = factory(Ledger::class, 5)->create();

        $collection = new LedgerCollection($ledger);

        $this->assertInstanceOf(LedgerCollection::class, $collection);
    }

    public function testResolveIsArray()
    {
    	$ledger = factory(Ledger::class, 1)->create();

        $collection = new LedgerCollection($ledger);
        
        $result = $collection->resolve();

        $this->assertIsArray($result);
    }

    public function testResolveHasData()
    {
    	$ledger = factory(Ledger::class, 1)->create();

        $collection = new LedgerCollection($ledger);

        $result = $collection->resolve();

        $this->assertArrayHasKey('data', $result);
    }

    public function testResolveDataIsCollection()
    {
    	$ledger = factory(Ledger::class, 1)->create();

        $collection = new LedgerCollection($ledger);

        $result = $collection->resolve();

        $data = $result['data'];

        $this->assertInstanceOf(Collection::class, $data);
    }

    public function testResolveDataCollectionIsLedgerResources()
    {
    	$ledger = factory(Ledger::class, 1)->create();

        $collection = new LedgerCollection($ledger);

        $result = $collection->resolve();

        $data = $result['data'];

        $first = $data->first();

        $this->assertInstanceOf(LedgerResource::class, $first);
    }
}
