<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\Models\User;
use App\Models\Account;
use App\Account\Repositories\EloquentAccountRepository;
use App\Account\Http\Resources\AccountResource;

class EloquentAccountRepositoryUpdateTest extends TestCase
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
        $data = [];

        $result = $this->repository->update($this->account->id, $data);

        $this->assertInstanceOf(AccountResource::class, $result);
    }

    public function testNameIsCorrect()
    {
        $data = [
        	'name' => 'modified'
		];

        $result = $this->repository->update($this->account->id, $data);

        $this->assertEquals($data['name'], $result->name);
    }

    public function testUserIdIsCorrect()
    {
        $user = factory(User::class)->create();

        $data = [
        	'user_id' => $user->id,
		];

        $result = $this->repository->update($this->account->id, $data);

        $this->assertEquals($data['user_id'], $result->user_id);
    }
}
