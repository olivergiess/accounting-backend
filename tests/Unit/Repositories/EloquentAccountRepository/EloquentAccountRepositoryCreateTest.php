<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\Models\User;
use App\Repositories\EloquentAccountRepository;
use App\Http\Resources\AccountResource;

class EloquentAccountRepositoryCreateTest extends TestCase
{
	use DatabaseMigrations;

	protected $user;
    protected $repository;

    public function additionalSetUp()
	{
		$this->user = factory(User::class)->create();

		$this->repository = $this->app->build(EloquentAccountRepository::class);
	}

	public function testSuccessful()
	{
		$data = [
			'name' => 'test',
			'user_id' => $this->user->id,
		];

		$result = $this->repository->create($data);

		$this->assertInstanceOf(AccountResource::class, $result);
	}
}
