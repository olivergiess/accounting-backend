<?php

namespace App\Models;

class Ledger extends Base
{
	protected $fillable = [
		'name',
		'balance',
		'account_id',
	];

	public function account()
	{
		return $this->belongsTo(Account::class);
	}

	public function creditors()
	{
		return $this->hasMany(Transaction::class, 'credit_ledger_id');
	}

	public function debitors()
	{
		return $this->hasMany(Transaction::class, 'debit_ledger_id');
	}
}