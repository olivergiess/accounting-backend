<?php

namespace App\Components\Transaction\Http\Resources;

use App\Components\Base\Http\Resources\BaseCollection;

class TransactionCollection extends BaseCollection
{
    public $collects = 'App\Components\Transaction\Http\Resources\TransactionResource';
}
