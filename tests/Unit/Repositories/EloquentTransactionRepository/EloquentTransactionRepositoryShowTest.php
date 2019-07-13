<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\Models\Transaction;
use App\Transaction\Repositories\EloquentTransactionRepository;
use App\Transaction\Http\Resources\TransactionResource;

class EloquentTransactionRepositoryShowTest extends TestCase
{
    use DatabaseMigrations;

    protected $transaction;
    protected $repository;

    public function additionalSetUp()
	{
		$this->transaction = factory(Transaction::class)->create();

		$this->repository = $this->app->build(EloquentTransactionRepository::class);
	}

    public function testSuccessful()
    {
        $result = $this->repository->show($this->transaction->id);

        $this->assertInstanceOf(TransactionResource::class, $result);
    }
}
