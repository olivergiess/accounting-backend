<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Ledger;

class LedgerResource extends JsonResource
{
    public function __construct(Ledger $resource)
	{
		parent::__construct($resource);
	}

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
		];
    }
}
