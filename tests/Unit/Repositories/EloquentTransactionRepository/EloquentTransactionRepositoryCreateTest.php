<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Ledger;
use App\Components\Transaction\Repositories\EloquentTransactionRepository;
use App\Components\Transaction\Http\Resources\TransactionResource;

class EloquentTransactionRepositoryCreateTest extends TestCase
{
	use DatabaseMigrations;

	protected $amount = 100;
	protected $creditee;
	protected $debitee;
    protected $repository;

    public function additionalSetUp()
	{
		list($this->creditee, $this->debitee) = factory(Ledger::class, 2)->create();

		$this->repository = $this->app->build(EloquentTransactionRepository::class);
	}

	public function testSuccessful()
	{
		$data = [
			'amount' => $this->amount,
			'credit_ledger_id' => $this->creditee->id,
			'debit_ledger_id'  => $this->debitee->id,
		];

		$result = $this->repository->create($data);

		$this->assertInstanceOf(TransactionResource::class, $result);
	}
}
