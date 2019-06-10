<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Repositories\EloquentTransactionRepository;
use App\Models\Ledger;
use App\Http\Resources\TransactionResource;

class EloquentTransactionRepositoryCreateTest extends TestCase
{
	use DatabaseMigrations;

	public function testSuccessful()
	{
		$from_ledger = factory(Ledger::class)->create();
		$to_ledger   = factory(Ledger::class)->create();

		$data = [
			'amount' => 100,
			'credit_ledger_id' => $to_ledger->id,
			'debit_ledger_id'  => $from_ledger->id,
		];

		$repository = $this->app->build(EloquentTransactionRepository::class);

		$result = $repository->create($data);

		$this->assertInstanceOf(TransactionResource::class, $result);
	}
}
