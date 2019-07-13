<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\Models\Account;
use App\Models\Ledger;
use App\Ledger\Repositories\EloquentLedgerRepository;
use App\Ledger\Http\Resources\LedgerResource;

class EloquentLedgerRepositoryUpdateTest extends TestCase
{
    use DatabaseMigrations;

    protected $ledger;
    protected $repository;

    public function additionalSetUp()
	{
		$this->ledger = factory(Ledger::class)->create();

		$this->repository = $this->app->build(EloquentLedgerRepository::class);
	}

	public function testSuccessful()
    {
		$data = [];

		$result = $this->repository->update($this->ledger->id, $data);

        $this->assertInstanceOf(LedgerResource::class, $result);
    }

    public function testNameIsCorrect()
    {
		$data = [
        	'name' => 'modified'
		];

		$result = $this->repository->update($this->ledger->id, $data);

        $this->assertEquals($data['name'], $result->name);
    }

    public function testAccountIdIsCorrect()
    {
		$account = factory(Account::class)->create();

		$data = [
        	'account_id' => $account->id,
		];

		$result = $this->repository->update($this->ledger->id, $data);

        $this->assertEquals($data['account_id'], $result->account_id);
    }
}
