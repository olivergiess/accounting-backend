<?php

namespace App\Libraries;

use App\Components\Ledger\Contracts\Repositories\LedgerRepository;

class Ledger
{
	protected $ledger;

	public function __construct(LedgerRepository $ledger)
	{
		$this->ledger = $ledger;
	}

	public function transfer(int $amount, int $from_ledger_id, int $to_ledger_id)
	{
		$this->ledger->decrementBalance($from_ledger_id, $amount);

		$this->ledger->incrementBalance($to_ledger_id, $amount);
	}
}
