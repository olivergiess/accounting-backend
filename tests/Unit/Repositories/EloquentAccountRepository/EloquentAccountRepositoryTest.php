<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use App\Account\Contracts\Repositories\AccountRepository;
use App\Account\Repositories\EloquentAccountRepository;

class EloquentAccountRepositoryTest extends TestCase
{
    public function testIsRegistered()
    {
        $repository = $this->app->make(AccountRepository::class);

        $this->assertInstanceOf(EloquentAccountRepository::class, $repository);
    }
}
