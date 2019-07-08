<?php

namespace App\Repositories;

use App\Contracts\Repositories\AccountRepository;
use App\Http\Resources\AccountResource;
use App\Models\Account;

class EloquentAccountRepository extends EloquentBaseRepository implements AccountRepository
{
    public function __construct(AccountResource $resource, Account $model)
    {
        parent::__construct($resource, $model);
    }
}
