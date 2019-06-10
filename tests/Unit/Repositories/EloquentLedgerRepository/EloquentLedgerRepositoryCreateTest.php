<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Repositories\EloquentLedgerRepository;
use App\Models\Account;
use App\Http\Resources\LedgerResource;

class EloquentLedgerRepositoryCreateTest extends TestCase
{
	use DatabaseMigrations;

	public function testSuccessful()
	{
		$account = factory(Account::class)->create();

		$data = [
			'name' => 'test',
			'account_id' => $account->id,
		];

		$repository = $this->app->build(EloquentLedgerRepository::class);

		$result = $repository->create($data);

		$this->assertInstanceOf(LedgerResource::class, $result);
	}
}
