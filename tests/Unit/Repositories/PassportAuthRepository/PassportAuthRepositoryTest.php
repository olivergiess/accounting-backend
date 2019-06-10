<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use App\Contracts\Repositories\AuthRepository;
use App\Repositories\PassportAuthRepository;

class PassportAuthRepositoryTest extends TestCase
{
    public function testIsRegistered()
    {
        $repository = $this->app->make(AuthRepository::class);

        $this->assertInstanceOf(PassportAuthRepository::class, $repository);
    }
}
