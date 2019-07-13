<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\Models\Ledger;
use App\Ledger\Repositories\EloquentLedgerRepository;
use App\Ledger\Http\Resources\LedgerResource;

class EloquentLedgerRepositoryShowTest extends TestCase
{
    use DatabaseMigrations;

    protected $ledger;
    protected $repository;

    public function additionalSetUp()
	{
		$this->ledger = factory(Ledger::class)->create();

		$this->repository = $this->app->build(EloquentLedgerRepository::class);
	}

    public function testSuccessful()
    {
        $result = $this->repository->show($this->ledger->id);

        $this->assertInstanceOf(LedgerResource::class, $result);
    }
}
