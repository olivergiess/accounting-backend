<?php

namespace App\Ledger\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LedgerStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
    		'name'      => 'required|string',
			'account_id' => 'bail|required|integer|exists:accounts,id|can:App\Account\Http\Resources\AccountResource,view',
		];
    }
}
