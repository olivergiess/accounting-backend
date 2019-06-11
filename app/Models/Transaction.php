<?php

namespace App\Models;

class Transaction extends Base
{
    protected $fillable = [
        'amount',
        'credit_ledger_id',
        'debit_ledger_id',
    ];

	public function creditee()
	{
		return $this->belongsTo('\App\Models\Ledger', 'credit_ledger_id');
	}

    public function debitee()
	{
		return $this->belongsTo('\App\Models\Ledger', 'debit_ledger_id');
	}
}