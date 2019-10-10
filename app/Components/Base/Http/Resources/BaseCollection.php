<?php

namespace App\Components\Base\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

use Illuminate\Support\Collection;

abstract class BaseCollection extends ResourceCollection
{
    public function __construct(Collection $resource)
	{
		parent::__construct($resource);
	}

    public function toArray($request)
    {
        return [
            'data' => $this->collection,
        ];
    }
}
