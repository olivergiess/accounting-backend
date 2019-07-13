<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\Models\Ledger;
use App\Ledger\Repositories\EloquentLedgerRepository;

class EloquentLedgerRepositoryIncrementBalanceTest extends TestCase
{
	use DatabaseMigrations;

    protected $ledger;
    protected $repository;

    public function additionalSetUp()
	{
		$this->ledger = factory(Ledger::class)->create();

		$this->repository = $this->app->build(EloquentLedgerRepository::class);
	}

    public function testBalanceIsCorrect()
    {
		$this->repository->incrementBalance($this->ledger->id, 100);

        $this->ledger->refresh();

        $this->assertEquals(100, $this->ledger->balance);
    }
}
