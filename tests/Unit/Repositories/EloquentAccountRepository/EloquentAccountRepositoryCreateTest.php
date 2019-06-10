<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Repositories\EloquentAccountRepository;
use App\Http\Resources\AccountResource;

class EloquentAccountRepositoryCreateTest extends TestCase
{
	use DatabaseMigrations;

	public function testSuccessful()
	{
		$user = factory(\App\Models\User::class)->create();

		$data = [
			'name' => 'test',
			'user_id' => $user->id,
		];

		$repository = $this->app->build(EloquentAccountRepository::class);

		$result = $repository->create($data);

		$this->assertInstanceOf(AccountResource::class, $result);
	}
}
