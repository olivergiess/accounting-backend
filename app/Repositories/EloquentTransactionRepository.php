<?php

namespace App\Repositories;

use App\Contracts\Repositories\TransactionRepository;

use App\Models\Transaction;
use App\Http\Resources\TransactionResource;
use App\Http\Resources\TransactionCollection;

class EloquentTransactionRepository extends EloquentBaseRepository implements TransactionRepository
{
    public function __construct(Transaction $model, TransactionResource $resource, TransactionCollection $collection)
    {
        parent::__construct($model, $resource, $collection);
    }
}
