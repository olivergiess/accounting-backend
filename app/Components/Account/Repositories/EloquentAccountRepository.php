<?php

namespace App\Components\Account\Repositories;

use App\Components\Base\Repositories\EloquentBaseRepository;
use App\Components\Account\Contracts\Repositories\AccountRepository;

use App\Models\Account;
use App\Components\Account\Http\Resources\AccountResource;
use App\Components\Account\Http\Resources\AccountCollection;

class EloquentAccountRepository extends EloquentBaseRepository implements AccountRepository
{
    public function __construct(Account $model, AccountResource $resource, AccountCollection $collection)
    {
        parent::__construct($model, $resource, $collection);
    }
}
