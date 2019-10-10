<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;

use App\Components\Transaction\Contracts\Repositories\TransactionRepository;
use App\Components\Transaction\Repositories\EloquentTransactionRepository;

class EloquentTransactionRepositoryTest extends TestCase
{
    public function testIsRegistered()
    {
        $repository = $this->app->make(TransactionRepository::class);

        $this->assertInstanceOf(EloquentTransactionRepository::class, $repository);
    }
}
