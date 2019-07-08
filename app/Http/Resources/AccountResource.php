<?php

namespace App\Http\Resources;

use App\Models\Account;

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
