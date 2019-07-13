<?php

namespace App\Transaction\Http\Resources;

use App\Base\Http\Resources\BaseCollection;

class TransactionCollection extends BaseCollection
{
    public $collects = 'App\Transaction\Http\Resources\TransactionResource';
}
