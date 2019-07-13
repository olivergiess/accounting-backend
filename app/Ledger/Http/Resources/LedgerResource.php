<?php

namespace App\Ledger\Http\Resources;

use App\Base\Http\Resources\BaseResource;

use App\Models\Ledger;
use App\Account\Http\Resources\AccountResource;
use App\Transaction\Http\Resources\TransactionCollection;

class LedgerResource extends BaseResource
{
    public function __construct(Ledger $resource)
	{
		parent::__construct($resource);
	}

	protected $relations = [
		'account' => AccountResource::class,
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
