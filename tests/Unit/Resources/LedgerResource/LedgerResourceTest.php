<?php

namespace Tests\Unit\Resources;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\Models\Ledger;
use App\Ledger\Http\Resources\LedgerResource;

class LedgerResourceTest extends TestCase
{
	use DatabaseMigrations;

    public function testCanBeInstantiated()
    {
    	$ledger = factory(Ledger::class)->create();

        $ledger_resource = new LedgerResource($ledger);

        $this->assertInstanceOf(LedgerResource::class, $ledger_resource);
    }
}
