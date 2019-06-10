<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Repositories\EloquentAccountRepository;
use App\Models\Account;
use App\Http\Resources\AccountResource;

class AccountRepositoryShowTest extends TestCase
{
    use DatabaseMigrations;

    public function testSuccessful()
    {
		$account = factory(Account::class)->create();

        $repository = $this->app->build(EloquentAccountRepository::class);

        $result = $repository->show($account->id);

        $this->assertInstanceOf(AccountResource::class, $result);
    }
}
