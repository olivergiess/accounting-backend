<?php

namespace App\Models;

class Ledger extends Base
{
	protected $fillable = [
		'name',
		'balance',
		'account_id',
	];

	protected $with = 'account';

	public function account()
	{
		return $this->belongsTo(Account::class);
	}
}