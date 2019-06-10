<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Transaction;

class TransactionResource extends JsonResource
{
	public function __construct(Transaction $resource)
	{
		parent::__construct($resource);
	}

    public function toArray($request = FALSE)
    {
        return [
			'type'       => 'transaction',
			'id'         => $this->id,
			'attributes' => [
				'amount'            => $this->amount,
				'credit_ledger_id' => $this->credit_ledger_id,
				'debit_ledger_id'  => $this->debit_ledger_id,
			]
		];
    }
}
