<?php

namespace Tests\Unit\Repositories;

use Illuminate\Database\Eloquent\RelationNotFoundException;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\Models\Transaction;
use App\Repositories\EloquentTransactionRepository;

class EloquentTransactionRepositoryExpandTest extends TestCase
{
	use DatabaseMigrations;

	protected $transaction;
    protected $repository;

    public function additionalSetUp()
	{
		$this->transaction = factory(Transaction::class)->create();

		$this->repository = $this->app->build(EloquentTransactionRepository::class);
	}

	public function testCrediteeCanBeExpanded()
	{
		$this->repository->expand('creditee');

		$result = $this->repository->show($this->transaction->id);

		$this->assertTrue($result->resource->relationLoaded('creditee'));
	}

	public function testDebiteeCanBeExpanded()
	{
		$this->repository->expand('debitee');

		$result = $this->repository->show($this->transaction->id);

		$this->assertTrue($result->resource->relationLoaded('debitee'));
	}

	public function testInvalidThrowsRelationNotFoundException()
	{
		$this->repository->expand('invalidRelationship');

		$this->expectException(RelationNotFoundException::class);

		$this->repository->show($this->transaction->id);
	}
}
