<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Repositories\EloquentAccountRepository;
use App\Models\Account;
use App\Models\User;
use App\Http\Resources\AccountResource;

class EloquentAccountRepositoryUpdateTest extends TestCase
{
    use DatabaseMigrations;

    public function testSuccessful()
    {
		$account = factory(Account::class)->create();

        $repository = $this->app->build(EloquentAccountRepository::class);

        $data = [
		];

        $result = $repository->update($account->id, $data);

        $this->assertInstanceOf(AccountResource::class, $result);
    }

    public function testNameIsCorrect()
    {
        $account = factory(Account::class)->create();

        $repository = $this->app->build(EloquentAccountRepository::class);

        $data = [
        	'name' => 'modified'
		];

        $result = $repository->update($account->id, $data);

        $this->assertEquals($data['name'], $result->name);
    }

    public function testUserIdIsCorrect()
    {
        $account = factory(Account::class)->create();

        $repository = $this->app->build(EloquentAccountRepository::class);

        $user = factory(User::class)->create();

        $data = [
        	'user_id' => $user->id,
		];

        $result = $repository->update($account->id, $data);

        $this->assertEquals($data['user_id'], $result->user_id);
    }
}
