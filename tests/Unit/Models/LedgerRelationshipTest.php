<?php

namespace Tests\Unit\Libraries;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Ledger;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LedgerRelationshipTest extends TestCase
{
    use DatabaseMigrations;

    public function testAccountReturnsBelongsTo()
    {
        $ledger = factory(Ledger::class)->create();

        $result = $ledger->account();

        $this->assertInstanceOf(BelongsTo::class, $result);
    }
}
