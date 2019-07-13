<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Transaction;
use App\Models\Ledger;
use App\Transaction\Repositories\EloquentTransactionRepository;
use App\Transaction\Http\Resources\TransactionResource;

class EloquentTransactionRepositoryUpdateTest extends TestCase
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
		$data = [
		];

		$result = $this->repository->update($this->transaction->id, $data);

        $this->assertInstanceOf(TransactionResource::class, $result);
    }

    public function testAmountIsCorrect()
    {
		$data = [
        	'amount' => 100
		];

		$result = $this->repository->update($this->transaction->id, $data);

        $this->assertEquals($data['amount'], $result->amount);
    }

    public function testCreditLedgerIdIsCorrect()
    {
		$creditee = factory(Ledger::class)->create();

		$data = [
        	'credit_ledger_id' => $creditee->id,
		];

		$result = $this->repository->update($this->transaction->id, $data);

        $this->assertEquals($data['credit_ledger_id'], $result->credit_ledger_id);
    }

    public function testDebitLedgerIdIsCorrect()
    {
		$debitee = factory(Ledger::class)->create();

		$data = [
        	'debit_ledger_id' => $debitee->id,
		];

		$result = $this->repository->update($this->transaction->id, $data);

        $this->assertEquals($data['debit_ledger_id'], $result->debit_ledger_id);
    }
}
