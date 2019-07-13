<?php

namespace App\Ledger\Http\Resources;

use App\Base\Http\Resources\BaseCollection;

class LedgerCollection extends BaseCollection
{
    public $collects = 'App\Ledger\Http\Resources\LedgerResource';
}
