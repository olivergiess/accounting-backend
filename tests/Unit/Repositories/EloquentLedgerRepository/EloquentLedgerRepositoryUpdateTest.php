<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Repositories\EloquentLedgerRepository;
use App\Models\Ledger;
use App\Models\Account;
use App\Http\Resources\LedgerResource;

class EloquentLedgerRepositoryUpdateTest extends TestCase
{
    use DatabaseMigrations;

    public function testSuccessful()
    {
		$ledger = factory(Ledger::class)->create();

		$data = [];

		$repository = $this->app->build(EloquentLedgerRepository::class);

		$result = $repository->update($ledger->id, $data);

        $this->assertInstanceOf(LedgerResource::class, $result);
    }

    public function testNameIsCorrect()
    {
        $ledger = factory(Ledger::class)->create();

		$data = [
        	'name' => 'modified'
		];

		$repository = $this->app->build(EloquentLedgerRepository::class);

		$result = $repository->update($ledger->id, $data);

        $this->assertEquals($data['name'], $result->name);
    }

    public function testAccountIdIsCorrect()
    {
        $ledger = factory(Ledger::class)->create();

		$account = factory(Account::class)->create();

		$data = [
        	'account_id' => $account->id,
		];

		$repository = $this->app->build(EloquentLedgerRepository::class);

		$result = $repository->update($ledger->id, $data);

        $this->assertEquals($data['account_id'], $result->account_id);
    }
}
