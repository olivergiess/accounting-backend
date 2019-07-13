<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use App\Ledger\Contracts\Repositories\LedgerRepository;
use App\Ledger\Repositories\EloquentLedgerRepository;

class EloquentLedgerRepositoryTest extends TestCase
{
    public function testIsRegistered()
    {
        $repository = $this->app->make(LedgerRepository::class);

        $this->assertInstanceOf(EloquentLedgerRepository::class, $repository);
    }
}
