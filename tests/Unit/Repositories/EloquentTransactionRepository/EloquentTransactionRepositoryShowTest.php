<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Repositories\EloquentTransactionRepository;
use App\Models\Transaction;
use App\Http\Resources\TransactionResource;

class EloquentTransactionRepositoryShowTest extends TestCase
{
    use DatabaseMigrations;

    public function testSuccessful()
    {
		$transaction = factory(Transaction::class)->create();

        $repository = $this->app->build(EloquentTransactionRepository::class);

        $result = $repository->show($transaction->id);

        $this->assertInstanceOf(TransactionResource::class, $result);
    }
}
