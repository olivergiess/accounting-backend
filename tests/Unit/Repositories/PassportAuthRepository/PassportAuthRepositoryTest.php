<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use App\Contracts\Repositories\AuthRepository;
use App\Repositories\PassportAuthRepository;

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
