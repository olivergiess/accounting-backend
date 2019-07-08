<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TransactionCollection extends ResourceCollection
{
    public $collects = 'App\Http\Resources\TransactionResource';

    public function toArray($request)
    {
        return [
            'data' => $this->collection,
        ];
    }
}
