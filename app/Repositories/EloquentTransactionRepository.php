<?php

namespace App\Repositories;

use App\Contracts\Repositories\TransactionRepository;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;

class EloquentTransactionRepository extends EloquentBaseRepository implements TransactionRepository
{
    public function __construct(TransactionResource $resource, Transaction $model)
    {
        parent::__construct($resource, $model);
    }
}
