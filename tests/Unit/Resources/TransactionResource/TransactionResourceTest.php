<?php

namespace Tests\Unit\Resources;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\Models\Transaction;
use App\Components\Transaction\Http\Resources\TransactionResource;

class TransactionResourceTest extends TestCase
{
	use DatabaseMigrations;

    public function testCanBeInstantiated()
    {
    	$transaction = factory(Transaction::class)->create();

        $resource = new TransactionResource($transaction);

        $this->assertInstanceOf(TransactionResource::class, $resource);
    }
}
