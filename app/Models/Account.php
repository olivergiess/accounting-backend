<?php

namespace App\Models;

class Account extends Base
{
    protected $fillable = [
		'name',
		'user_id',
	];

	protected $hidden = [
		'created_at',
		'updated_at'
	];

	public function user()
	{
		return $this->belongsTo('App\Models\User');
	}

	public function ledgers()
	{
		return $this->hasMany('App\Models\Ledger');
	}
}