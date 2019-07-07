<?php

namespace App\Http\Controllers\Account;

use App\Contracts\Repositories\AccountRepository;

class LedgerController extends Controller
{
	protected $account;

	public function __construct(AccountRepository $account)
	{
		$this->account = $account;
	}

	public function all(int $accountId)
    {
    	$ledgers = $this->account->ledgers($accountId);

		return $ledgers;
    }
}