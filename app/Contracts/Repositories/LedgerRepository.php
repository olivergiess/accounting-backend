<?php

namespace App\Contracts\Repositories;

interface LedgerRepository extends BaseRepository
{
    public function incrementBalance(int $account_id, int $amount);

	public function decrementBalance(int $account_id, int $amount);
}
