<?php

namespace App\Components\Transaction\Repositories;

use App\Components\Base\Repositories\EloquentBaseRepository;
use App\Components\Transaction\Contracts\Repositories\TransactionRepository;

use App\Models\Transaction;
use App\Components\Transaction\Http\Resources\TransactionResource;
use App\Components\Transaction\Http\Resources\TransactionCollection;

class EloquentTransactionRepository extends EloquentBaseRepository implements TransactionRepository
{
    public function __construct(Transaction $model, TransactionResource $resource, TransactionCollection $collection)
    {
        parent::__construct($model, $resource, $collection);
    }
}
