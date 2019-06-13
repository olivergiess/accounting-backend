<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'amount'           => 'required|integer',
			'credit_ledger_id' => 'bail|required|exists:ledgers,id|can:App\Http\Resources\LedgerResource,view',
			'debit_ledger_id'  => 'bail|required|exists:ledgers,id|can:App\Http\Resources\LedgerResource,view',
        ];
    }
}
