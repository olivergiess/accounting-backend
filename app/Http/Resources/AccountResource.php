<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Account;

class AccountResource extends JsonResource
{
    public function __construct(Account $resource)
    {
        parent::__construct($resource);
    }

    public function toArray($request = FALSE)
    {
        return [
            'type' => 'account',
            'id' => $this->id,
            'attributes' => [
                'name' => $this->name,
            ],
			'relationships' => [
				'ledgers' => new LedgerCollection($this->ledgers)
			],
        ];
    }
}
