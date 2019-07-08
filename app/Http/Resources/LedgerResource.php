<?php

namespace App\Http\Resources;

use App\Models\Ledger;

class LedgerResource extends BaseResource
{
    public function __construct(Ledger $resource)
	{
		parent::__construct($resource);
	}

	protected $relations = [
		'creditors' => TransactionCollection::class,
		'debitors' => TransactionCollection::class,
	];

	public function toArray($request = FALSE)
    {
        return [
				'type' => 'ledger',
				'id' => $this->id,
				'attributes' => [
					'name' => $this->name,
					'balance' => $this->balance,
					'account_id' => $this->account_id
				],
			] + $this->relationships();
    }
}
