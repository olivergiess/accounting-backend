<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\Models\Account;
use App\Components\Account\Repositories\EloquentAccountRepository;
use App\Components\Account\Http\Resources\AccountResource;

class AccountRepositoryShowTest extends TestCase
{
    use DatabaseMigrations;

    protected $account;
    protected $repository;

    public function additionalSetUp()
	{
		$this->account = factory(Account::class)->create();

		$this->repository = $this->app->build(EloquentAccountRepository::class);
	}

	public function testSuccessful()
    {
        $result = $this->repository->show($this->account->id);

        $this->assertInstanceOf(AccountResource::class, $result);
    }
}
