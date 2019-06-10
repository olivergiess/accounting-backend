<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use App\Contracts\Repositories\LedgerRepository;
use App\Repositories\EloquentLedgerRepository;

class EloquentLedgerRepositoryTest extends TestCase
{
    public function testIsRegistered()
    {
        $repository = $this->app->make(LedgerRepository::class);

        $this->assertInstanceOf(EloquentLedgerRepository::class, $repository);
    }
}
