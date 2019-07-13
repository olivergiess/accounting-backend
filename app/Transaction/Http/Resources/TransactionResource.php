<?php

namespace App\Transaction\Http\Resources;

use App\Base\Http\Resources\BaseResource;

use App\Models\Transaction;
use App\Ledger\Http\Resources\LedgerResource;

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
