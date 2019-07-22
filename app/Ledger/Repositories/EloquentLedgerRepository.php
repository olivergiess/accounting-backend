<?php

namespace App\Ledger\Repositories;

use App\Base\Repositories\EloquentBaseRepository;
use App\Ledger\Contracts\Repositories\LedgerRepository;

use App\Models\Ledger;
use App\Ledger\Http\Resources\LedgerResource;
use App\Ledger\Http\Resources\LedgerCollection;

class EloquentLedgerRepository extends EloquentBaseRepository implements LedgerRepository
{
    public function __construct(Ledger $model, LedgerResource $resource, LedgerCollection $collection)
    {
        parent::__construct($model, $resource, $collection);
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