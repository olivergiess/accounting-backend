<?php

namespace App\Account\Http\Resources;

use App\Base\Http\Resources\BaseResource;

use App\Models\Account;
use App\Ledger\Http\Resources\LedgerCollection;

class AccountResource extends BaseResource
{
    public function __construct(Account $resource)
    {
        parent::__construct($resource);
    }

    protected $relations = [
    	'ledgers' => LedgerCollection::class
	];

    public function toArray($request = FALSE)
    {
        return [
				'type' => 'account',
				'id' => $this->id,
				'attributes' => [
					'name' => $this->name,
				],
			] + $this->relationships();
    }
}
