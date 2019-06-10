<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Ledger;
use App\Repositories\EloquentLedgerRepository;

class EloquentLedgerRepositoryDecrementBalanceTest extends TestCase
{
	use DatabaseMigrations;

    public function testBalanceIsCorrect()
    {
        $ledger = factory(Ledger::class)->create();

        $repository = $this->app->build(EloquentLedgerRepository::class);

		$repository->decrementBalance($ledger->id, 100);

        $ledger->refresh();

        $this->assertEquals(-100, $ledger->balance);
    }
}
