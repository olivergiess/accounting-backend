<?php

namespace Tests\Unit\Libraries;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Account;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AccountRelationshipTest extends TestCase
{
    use DatabaseMigrations;

    protected $account;

    public function additionalSetUp()
	{
		$this->account = factory(Account::class)->create();
	}

    public function testUserReturnsBelongsTo()
    {
        $result = $this->account->user();

        $this->assertInstanceOf(BelongsTo::class, $result);
    }

    public function testLedgersReturnsHasMany()
    {
        $result = $this->account->ledgers();

        $this->assertInstanceOf(HasMany::class, $result);
    }
}
