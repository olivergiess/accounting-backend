<?php

namespace Tests\Unit\Resources;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Account;
use App\Http\Resources\AccountResource;

class AccountResourceTest extends TestCase
{
    use DatabaseMigrations;

    public function testCanBeInstantiated()
    {
        $account = factory(Account::class)->create();

        $resource = new AccountResource($account);

        $this->assertInstanceOf(AccountResource::class, $resource);
    }
}
