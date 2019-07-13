<?php

namespace App\Transaction\Http\Controllers;

use App\Base\Http\Controllers\BaseController;
use App\Http\Traits\Expandable;

use App\Transaction\Contracts\Repositories\TransactionRepository;
use App\Ledger\Contracts\Repositories\LedgerRepository;
use App\Libraries\Ledger;
use App\Transaction\Http\Requests\TransactionStoreRequest;
use Illuminate\Http\Request;

class TransactionController extends BaseController
{
	use Expandable;

    protected $transaction;
    protected $ledgerRepository;
    protected $ledger;

    public function __construct(TransactionRepository $transaction,
								LedgerRepository $ledgerRepository,
								Ledger $ledger)
	{
        $this->transaction = $transaction;
        $this->ledgerRepository = $ledgerRepository;
		$this->ledger     = $ledger;
    }

    public function store(TransactionStoreRequest $request)
    {
        $data = $request->validated();

        $credit_ledger = $this->ledgerRepository->show($data['credit_ledger_id']);
		$debit_ledger  = $this->ledgerRepository->show($data['debit_ledger_id']);

		// TODO: This needs to be refactored, fugly AF.
		if($credit_ledger->account_id != $debit_ledger->account_id)
			return response()->json([
				'message'=>'',
				'errors'=>[
					'credit_ledger_id'=>'The credit ledger must belong to the same account as the debit ledger.',
					'debit_ledger_id'=>'The debit ledger must belong to the same account as the credit ledger.'
				]
									], 422);

		$transaction = $this->transaction->create($data);

        $this->ledger->transfer($transaction->amount, $transaction->debit_ledger_id, $transaction->credit_ledger_id);

		return $transaction;
    }

    public function show(int $id, Request $request)
    {
    	$this->expand($request, $this->transaction);

        $transaction = $this->transaction->show($id);

        return $transaction;
    }

    public function delete(int $id)
    {
    	$transaction = $this->transaction->show($id);

        $this->ledger->transfer($transaction->amount, $transaction->credit_ledger_id, $transaction->debit_ledger_id);

		$transaction->delete();

        return response('', 204);
    }
}