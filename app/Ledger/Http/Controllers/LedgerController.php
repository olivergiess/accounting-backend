<?php

namespace App\Ledger\Http\Controllers;

use App\Base\Http\Controllers\BaseController;
use App\Http\Traits\Expandable;

use App\Ledger\Contracts\Repositories\LedgerRepository;
use App\Ledger\Http\Requests\LedgerStoreRequest;
use App\Ledger\Http\Requests\LedgerUpdateRequest;
use Illuminate\Http\Request;

class LedgerController extends BaseController
{
	use Expandable;

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

	public function show(int $id, Request $request)
	{
		$this->expand($request, $this->ledger);

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