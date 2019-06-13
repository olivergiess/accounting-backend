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
    	$data = $request->validated();

    	$ledger = $this->ledger->create($data);

		return $ledger;
    }

	public function show(int $id)
	{
		$ledger = $this->ledger->show($id);

		return $ledger;
	}

	public function update(LedgerUpdateRequest $request, int $id)
	{
		$data = $request->validated();

		$ledger = $this->ledger->update($id, $data);

		return $ledger;
	}
}