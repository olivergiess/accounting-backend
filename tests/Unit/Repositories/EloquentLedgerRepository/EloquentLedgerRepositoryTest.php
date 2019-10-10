<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use App\Components\Ledger\Contracts\Repositories\LedgerRepository;
use App\Components\Ledger\Repositories\EloquentLedgerRepository;

class EloquentLedgerRepositoryTest extends TestCase
{
    public function testIsRegistered()
    {
        $repository = $this->app->make(LedgerRepository::class);

        $this->assertInstanceOf(EloquentLedgerRepository::class, $repository);
    }
}
