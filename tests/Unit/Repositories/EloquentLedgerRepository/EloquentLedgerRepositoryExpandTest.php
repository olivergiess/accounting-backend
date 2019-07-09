<?php

namespace Tests\Unit\Repositories;

use Illuminate\Database\Eloquent\RelationNotFoundException;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\Models\Ledger;
use App\Repositories\EloquentLedgerRepository;

class EloquentLedgerRepositoryExpandTest extends TestCase
{
	use DatabaseMigrations;

	protected $ledger;
    protected $repository;

    public function additionalSetUp()
	{
		$this->ledger = factory(Ledger::class)->create();

		$this->repository = $this->app->build(EloquentLedgerRepository::class);
	}

	public function testAccountCanBeExpanded()
	{
		$this->repository->expand('account');

		$result = $this->repository->show($this->ledger->id);

		$this->assertTrue($result->resource->relationLoaded('account'));
	}

	public function testCreditorsCanBeExpanded()
	{
		$this->repository->expand('creditors');

		$result = $this->repository->show($this->ledger->id);

		$this->assertTrue($result->resource->relationLoaded('creditors'));
	}

	public function testDebitorsCanBeExpanded()
	{
		$this->repository->expand('debitors');

		$result = $this->repository->show($this->ledger->id);

		$this->assertTrue($result->resource->relationLoaded('debitors'));
	}

	public function testInvalidThrowsRelationNotFoundException()
	{
		$this->repository->expand('invalidRelationship');

		$this->expectException(RelationNotFoundException::class);

		$this->repository->show($this->ledger->id);
	}
}
