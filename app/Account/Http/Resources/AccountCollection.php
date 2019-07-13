<?php

namespace App\Account\Http\Resources;

use App\Base\Http\Resources\BaseCollection;

class AccountCollection extends BaseCollection
{
    public $collects = 'App\Account\Http\Resources\AccountResource';
}