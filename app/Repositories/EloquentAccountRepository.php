<?php

namespace App\Repositories;

use App\Contracts\Repositories\AccountRepository;

use App\Models\Account;
use App\Http\Resources\AccountResource;
use App\Http\Resources\AccountCollection;

class EloquentAccountRepository extends EloquentBaseRepository implements AccountRepository
{
    public function __construct(Account $model, AccountResource $resource, AccountCollection $collection)
    {
        parent::__construct($model, $resource, $collection);
    }
}
