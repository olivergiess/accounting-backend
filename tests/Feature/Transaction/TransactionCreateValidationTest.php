<?php

namespace Tests\Feature\Account;

use App\Models\Ledger;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\User;
use Laravel\Passport\Passport;

class TransactionCreateValidationTest extends TestCase
{
    use DatabaseMigrations;

    private function feature($payload = [])
    {
        $user = factory(User::class)->create();

        Passport::actingAs($user);

        $response = $this->post('/api/transactions', $payload);

        return $response;
    }

    private function errors($payload = [])
    {
        $response = $this->feature($payload);

        $content = $response->getContent();

        $json = json_decode($content);

        $errors = $json->errors;

        return $errors;
    }

    public function testResponseCodeIs422()
    {
        $response = $this->feature();

        $this->assertEquals(422, $response->getStatusCode());
    }

    public function testContentIsJson()
    {
        $response = $this->feature();

        $this->assertJson($response->getContent());
    }

    public function testJsonHasErrors()
    {
        $response = $this->feature();

        $content = $response->getContent();

        $json = json_decode($content);

        $this->assertObjectHasAttribute('errors', $json);
    }

    public function testErrorsHasAmount()
    {
        $errors = $this->errors();

        $this->assertObjectHasAttribute('amount', $errors);
    }

    public function testAmountIsRequired()
    {
        $errors = $this->errors();

        $this->assertContains('The amount field is required.', $errors->amount);
    }

    public function testAmountMustBeAnInteger()
    {
        $errors = $this->errors(['amount' => 'wasd']);

        $this->assertContains('The amount must be an integer.', $errors->amount);
    }

    public function testErrorsHasCreditLedgerId()
    {
        $errors = $this->errors();

        $this->assertObjectHasAttribute('credit_ledger_id', $errors);
    }

    public function testCreditLedgerIdIsRequired()
    {
        $errors = $this->errors();

        $this->assertContains('The credit ledger id field is required.', $errors->credit_ledger_id);
    }

    public function testCreditLedgerIdMustBeValid()
    {
        $errors = $this->errors(['credit_ledger_id' => 'wasd']);

        $this->assertContains('The selected credit ledger id is invalid.', $errors->credit_ledger_id);
    }

    public function testCreditLedgerIdMustBelongToAuthenticatedUser()
    {
    	$ledger = factory(Ledger::class)->create();

        $errors = $this->errors(['credit_ledger_id' => $ledger->id]);

        $this->assertContains('The selected credit ledger id is invalid.', $errors->credit_ledger_id);
    }

    public function testErrorsHasDebitLedgerId()
    {
        $errors = $this->errors();

        $this->assertObjectHasAttribute('debit_ledger_id', $errors);
    }

    public function testDebitLedgerIdIsRequired()
    {
        $errors = $this->errors();

        $this->assertContains('The debit ledger id field is required.', $errors->debit_ledger_id);
    }

    public function testDebitLedgerIdMustBeValid()
    {
        $errors = $this->errors(['debit_ledger_id' => 'wasd']);

        $this->assertContains('The selected debit ledger id is invalid.', $errors->debit_ledger_id);
    }

    public function testDebitLedgerIdMustBelongToAuthenticatedUser()
    {
    	$ledger = factory(Ledger::class)->create();

        $errors = $this->errors(['debit_ledger_id' => $ledger->id]);

        $this->assertContains('The selected debit ledger id is invalid.', $errors->debit_ledger_id);
    }
}
