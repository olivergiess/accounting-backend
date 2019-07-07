<?php

namespace App\Repositories;

use App\Contracts\Repositories\AccountRepository;
use App\Http\Resources\AccountResource;
use App\Models\Account;

class EloquentAccountRepository extends EloquentBaseRepository implements AccountRepository
{
    public function __construct(AccountResource $resource, LedgerCollection $ledgerCollection, Account $model)
    {
    	$this->ledgerCollection = $ledgerCollection;

        parent::__construct($resource, $model);
    }

    public function ledgers(int $id)
	{
		$account = $this->model::findOrFail($id);

		$ledgers = $account->ledgers();

		$result = $this->ledgerCollection->make($ledgers);

		return $result;
	}
}
