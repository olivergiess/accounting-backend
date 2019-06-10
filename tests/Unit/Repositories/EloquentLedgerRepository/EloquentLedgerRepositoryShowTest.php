<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Repositories\EloquentLedgerRepository;
use App\Models\Ledger;
use App\Http\Resources\LedgerResource;

class EloquentLedgerRepositoryShowTest extends TestCase
{
    use DatabaseMigrations;

    public function testSuccessful()
    {
		$ledger = factory(Ledger::class)->create();

        $repository = $this->app->build(EloquentLedgerRepository::class);

        $result = $repository->show($ledger->id);

        $this->assertInstanceOf(LedgerResource::class, $result);
    }
}
