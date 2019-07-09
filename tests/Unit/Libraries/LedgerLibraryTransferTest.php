<?php

namespace Tests\Unit\Libraries;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Ledger as LedgerModel;
use App\Libraries\Ledger;

class LedgerLibraryTransferTest extends TestCase
{
    use DatabaseMigrations;

    protected $from_ledger;
    protected $to_ledger;
    protected $library;

    public function additionalSetUp()
	{
		$this->from_ledger = factory(LedgerModel::class)->create();
        $this->to_ledger   = factory(LedgerModel::class)->create();

        $this->library = $this->app->build(Ledger::class);
	}

	public function testLedgerLibraryTransferUpdatesCreditLedgerBalanceCorrectly()
    {
        $this->library->transfer(100, $this->from_ledger->id, $this->to_ledger->id);

        $this->to_ledger->refresh();

        $this->assertEquals(100, $this->to_ledger->balance);
    }

    public function testLedgerLibraryTransferUpdatesDebitLedgerBalanceCorrectly()
    {
        $this->library->transfer(100, $this->from_ledger->id, $this->to_ledger->id);

        $this->from_ledger->refresh();

        $this->assertEquals(-100, $this->from_ledger->balance);
    }
}
