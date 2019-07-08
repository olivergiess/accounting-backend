<?php

namespace Tests\Unit\Libraries;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Ledger;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LedgerRelationshipTest extends TestCase
{
    use DatabaseMigrations;

    protected $ledger;

    public function additionalSetUp()
	{
		$this->ledger = factory(Ledger::class)->create();
	}

    public function testAccountReturnsBelongsTo()
    {
        $result = $this->ledger->account();

        $this->assertInstanceOf(BelongsTo::class, $result);
    }

    public function testCreditorsReturnsHasMany()
    {
        $result = $this->ledger->creditors();

        $this->assertInstanceOf(HasMany::class, $result);
    }

    public function testDebitorsReturnsHasMany()
    {
        $result = $this->ledger->debitors();

        $this->assertInstanceOf(HasMany::class, $result);
    }
}
