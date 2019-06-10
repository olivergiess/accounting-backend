<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\LedgerRepository;
use App\Http\Requests\LedgerStoreRequest;
use App\Http\Requests\LedgerUpdateRequest;

class LedgerController extends Controller
{
	protected $ledger;

	public function __construct(LedgerRepository $ledger)
	{
		$this->ledger  = $ledger;
	}

	public function store(LedgerStoreRequest $request)
    {
    	$validated = $request->validated();

    	$ledger = $this->ledger->create($validated);

		return $ledger;
    }

	public function show(int $id)
	{
		$ledger = $this->ledger->show($id);

		return $ledger;
	}

	public function update(LedgerUpdateRequest $request, int $id)
	{
		$validated = $request->validated();

		$ledger = $this->ledger->update($id, $validated);

		return $ledger;
	}
}