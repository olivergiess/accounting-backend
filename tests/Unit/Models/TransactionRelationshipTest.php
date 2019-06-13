<?php

namespace Tests\Unit\Libraries;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransactionRelationshipTest extends TestCase
{
    use DatabaseMigrations;

    protected $transaction;

    public function additionalSetUp()
	{
		$this->transaction = factory(Transaction::class)->create();
	}

	public function testCrediteeReturnsBelongsTo()
    {
        $result = $this->transaction->creditee();

        $this->assertInstanceOf(BelongsTo::class, $result);
    }

    public function testDebiteeReturnsBelongsTo()
    {
        $result = $this->transaction->debitee();

        $this->assertInstanceOf(BelongsTo::class, $result);
    }
}
