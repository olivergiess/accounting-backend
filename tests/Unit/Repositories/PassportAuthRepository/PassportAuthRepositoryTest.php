<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;

use App\Components\Auth\Contracts\Repositories\AuthRepository;
use App\Components\Auth\Repositories\PassportAuthRepository;

class PassportAuthRepositoryTest extends TestCase
{
	protected $repository;

	public function additionalSetUp()
	{
		$this->repository = $this->app->make(AuthRepository::class);
	}

	public function testIsRegistered()
    {
        $this->assertInstanceOf(PassportAuthRepository::class, $this->repository);
    }
}
