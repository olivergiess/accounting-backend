<?php

namespace App\Http\Resources;

use App\Models\Transaction;

class TransactionResource extends BaseResource
{
	public function __construct(Transaction $resource)
	{
		parent::__construct($resource);
	}

	protected $relations = [
		'creditee' => LedgerResource::class,
		'debitee' => LedgerResource::class
	];

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
			] + $this->relationships();
    }
}
