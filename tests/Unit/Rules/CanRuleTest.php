<?php

namespace Tests\Unit\Libraries;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\Http\Rules\Can;
use App\Account\Http\Resources\AccountResource;
use App\Models\User;
use Laravel\Passport\Passport;
use App\Models\Account;

class CanRuleTest extends TestCase
{
    use DatabaseMigrations;

    protected $action = 'owns';
    protected $rule;

    public function additionalSetUp()
	{
		$this->rule = new Can(AccountResource::class, $this->action);
	}

	public function testRuleExists()
    {
        $this->assertInstanceOf(Can::class, $this->rule);
    }

    public function testPasses()
	{
		$user = factory(User::class)->create();

		Passport::actingAs($user);

		$account = factory(Account::class)->create(['user_id' => $user->id]);

		$result = $this->rule->passes('account_id', $account->id);

		$this->assertTrue($result);
	}

	public function testFails()
	{
		$user = factory(User::class)->create();

		Passport::actingAs($user);

		$account = factory(Account::class)->create();

		$result = $this->rule->passes('account_id', $account->id);

		$this->assertFalse($result);
	}

	public function testMessageIsCorrect()
	{
		$message = $this->rule->message();

		$this->assertEquals('validation.can', $message);
	}
}
