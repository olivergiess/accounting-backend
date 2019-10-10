<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\Models\Account;
use App\Components\Ledger\Repositories\EloquentLedgerRepository;
use App\Components\Ledger\Http\Resources\LedgerResource;

class EloquentLedgerRepositoryCreateTest extends TestCase
{
	use DatabaseMigrations;

    protected $account;
    protected $repository;

    public function additionalSetUp()
	{
		$this->account = factory(Account::class)->create();

		$this->repository = $this->app->build(EloquentLedgerRepository::class);
	}

	public function testSuccessful()
	{
		$data = [
			'name' => 'test',
			'account_id' => $this->account->id,
		];

		$result = $this->repository->create($data);

		$this->assertInstanceOf(LedgerResource::class, $result);
	}
}
