<?php

namespace App\Components\Ledger\Contracts\Repositories;

use App\Components\Base\Contracts\Repositories\BaseRepository;

interface LedgerRepository extends BaseRepository
{
    public function incrementBalance(int $account_id, int $amount);

	public function decrementBalance(int $account_id, int $amount);
}
