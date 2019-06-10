<?php

namespace Tests\Unit\Libraries;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Ledger as LedgerModel;
use App\Libraries\Ledger;

class LedgerLibraryTransferTest extends TestCase
{
    use DatabaseMigrations;

    public function testLedgerLibraryTransferUpdatesCreditLedgerBalanceCorrectly()
    {
        $from_ledger = factory(LedgerModel::class)->create();
        $to_ledger   = factory(LedgerModel::class)->create();

        $ledger = $this->app->build(Ledger::class);

        $ledger->transfer(100, $from_ledger->id, $to_ledger->id);

        $to_ledger->refresh();

        $this->assertEquals(100, $to_ledger->balance);
    }

    public function testLedgerLibraryTransferUpdatesDebitLedgerBalanceCorrectly()
    {
        $from_ledger = factory(LedgerModel::class)->create();
        $to_ledger   = factory(LedgerModel::class)->create();

        $ledger = $this->app->build(Ledger::class);

        $ledger->transfer(100, $from_ledger->id, $to_ledger->id);

        $from_ledger->refresh();

        $this->assertEquals(-100, $from_ledger->balance);
    }
}
