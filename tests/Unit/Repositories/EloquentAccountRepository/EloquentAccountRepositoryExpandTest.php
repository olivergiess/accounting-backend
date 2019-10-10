<?php

namespace Tests\Unit\Repositories;

use Illuminate\Database\Eloquent\RelationNotFoundException;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\Models\Account;
use App\Components\Account\Repositories\EloquentAccountRepository;

class EloquentAccountRepositoryExpandTest extends TestCase
{
	use DatabaseMigrations;

	protected $account;
    protected $repository;

    public function additionalSetUp()
	{
		$this->account = factory(Account::class)->create();

		$this->repository = $this->app->build(EloquentAccountRepository::class);
	}

	public function testLedgersCanBeExpanded()
	{
		$this->repository->expand('ledgers');

		$result = $this->repository->show($this->account->id);

		$this->assertTrue($result->resource->relationLoaded('ledgers'));
	}

	public function testInvalidThrowsRelationNotFoundException()
	{
		$this->repository->expand('invalidRelationship');

		$this->expectException(RelationNotFoundException::class);

		$this->repository->show($this->account->id);
	}
}
