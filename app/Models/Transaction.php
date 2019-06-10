<?php

namespace App\Models;

class Transaction extends Base
{
    protected $fillable = [
        'amount',
        'credit_ledger_id',
        'debit_ledger_id',
    ];
}