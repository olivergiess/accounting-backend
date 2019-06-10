<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Repositories\EloquentTransactionRepository;
use App\Models\Transaction;
use App\Models\Ledger;
use App\Http\Resources\TransactionResource;

class EloquentTransactionRepositoryUpdateTest extends TestCase
{
    use DatabaseMigrations;

    public function testSuccessful()
    {
		$transaction = factory(Transaction::class)->create();

		$data = [
		];

		$repository = $this->app->build(EloquentTransactionRepository::class);

		$result = $repository->update($transaction->id, $data);

        $this->assertInstanceOf(TransactionResource::class, $result);
    }

    public function testAmountIsCorrect()
    {
        $transaction = factory(Transaction::class)->create();

		$data = [
        	'amount' => 100
		];

		$repository = $this->app->build(EloquentTransactionRepository::class);

		$result = $repository->update($transaction->id, $data);

        $this->assertEquals($data['amount'], $result->amount);
    }

    public function testCreditLedgerIdIsCorrect()
    {
        $transaction = factory(Transaction::class)->create();

		$credit_ledger = factory(Ledger::class)->create();

		$data = [
        	'credit_ledger_id' => $credit_ledger->id,
		];

		$repository = $this->app->build(EloquentTransactionRepository::class);

		$result = $repository->update($transaction->id, $data);

        $this->assertEquals($data['credit_ledger_id'], $result->credit_ledger_id);
    }

    public function testDebitLedgerIdIsCorrect()
    {
        $transaction = factory(Transaction::class)->create();

		$debit_ledger = factory(Ledger::class)->create();

		$data = [
        	'debit_ledger_id' => $debit_ledger->id,
		];

		$repository = $this->app->build(EloquentTransactionRepository::class);

		$result = $repository->update($transaction->id, $data);

        $this->assertEquals($data['debit_ledger_id'], $result->debit_ledger_id);
    }
}
