<?php

namespace Tests\Unit\Libraries;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Account;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AccountRelationshipTest extends TestCase
{
    use DatabaseMigrations;

    public function testAccountRelationshipLedgersReturnsInstanceOfHasMany()
    {
        $account = factory(Account::class)->create();

        $result = $account->ledgers();

        $this->assertInstanceOf(HasMany::class, $result);
    }
}
