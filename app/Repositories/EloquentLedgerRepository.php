<?php

namespace App\Repositories;

use App\Contracts\Repositories\LedgerRepository;
use App\Http\Resources\LedgerResource;
use App\Models\Ledger;

class EloquentLedgerRepository extends EloquentBaseRepository implements LedgerRepository
{
    public function __construct(LedgerResource $resource, Ledger $model)
    {
        parent::__construct($resource, $model);
    }

    public function incrementBalance(int $ledger_id, int $amount)
	{
		$ledger = $this->model::findOrFail($ledger_id);

		$ledger->increment('balance', $amount);

		$result = $this->resource->make($ledger);

		return $result;
	}

	public function decrementBalance(int $ledger_id, int $amount)
	{
		$ledger = $this->model::findOrFail($ledger_id);

		$ledger->decrement('balance', $amount);

		$result = $this->resource->make($ledger);

		return $result;
	}
}
