<?php

namespace App\Transaction\Repositories;

use App\Base\Repositories\EloquentBaseRepository;
use App\Transaction\Contracts\Repositories\TransactionRepository;

use App\Models\Transaction;
use App\Transaction\Http\Resources\TransactionResource;
use App\Transaction\Http\Resources\TransactionCollection;

class EloquentTransactionRepository extends EloquentBaseRepository implements TransactionRepository
{
    public function __construct(Transaction $model, TransactionResource $resource, TransactionCollection $collection)
    {
        parent::__construct($model, $resource, $collection);
    }
}
