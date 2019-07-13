<?php

namespace App\Account\Repositories;

use App\Base\Repositories\EloquentBaseRepository;
use App\Account\Contracts\Repositories\AccountRepository;

use App\Models\Account;
use App\Account\Http\Resources\AccountResource;
use App\Account\Http\Resources\AccountCollection;

class EloquentAccountRepository extends EloquentBaseRepository implements AccountRepository
{
    public function __construct(Account $model, AccountResource $resource, AccountCollection $collection)
    {
        parent::__construct($model, $resource, $collection);
    }
}
