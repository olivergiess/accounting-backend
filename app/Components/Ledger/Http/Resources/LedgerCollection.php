<?php

namespace App\Components\Ledger\Http\Resources;

use App\Components\Base\Http\Resources\BaseCollection;

class LedgerCollection extends BaseCollection
{
    public $collects = 'App\Components\Ledger\Http\Resources\LedgerResource';
}
