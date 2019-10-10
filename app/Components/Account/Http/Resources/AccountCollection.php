<?php

namespace App\Components\Account\Http\Resources;

use App\Components\Base\Http\Resources\BaseCollection;

class AccountCollection extends BaseCollection
{
    public $collects = 'App\Components\Account\Http\Resources\AccountResource';
}
