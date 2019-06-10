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
			'credit_ledger_id' => 'required|exists:ledgers,id',
			'debit_ledger_id'  => 'required|exists:ledgers,id',
        ];
    }
}
