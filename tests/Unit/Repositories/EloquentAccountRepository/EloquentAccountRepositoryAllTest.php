<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\Models\Account;
use App\Account\Repositories\EloquentAccountRepository;
use App\Account\Http\Resources\AccountCollection;

class EloquentAccountRepositoryAllTest extends TestCase
{
	use DatabaseMigrations;

	protected $accounts;
    protected $repository;

    public function additionalSetUp()
	{
		$this->accounts = factory(Account::class, 5)->create();

		$this->repository = $this->app->build(EloquentAccountRepository::class);
	}

	public function testSuccessful()
	{
		$result = $this->repository->all();

		$this->assertInstanceOf(AccountCollection::class, $result);
	}
}
