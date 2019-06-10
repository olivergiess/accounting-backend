<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class LedgerCollection extends ResourceCollection
{
    public $collects = 'App\Http\Resources\LedgerResource';

    public function toArray($request)
    {
        return [
            'data' => $this->collection,
        ];
    }
}
