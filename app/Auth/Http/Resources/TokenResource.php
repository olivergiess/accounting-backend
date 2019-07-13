<?php

namespace App\Auth\Http\Resources;

use App\Base\Http\Resources\BaseResource;

class TokenResource extends BaseResource
{
    public function toArray($request = FALSE)
    {
        return [
        	'accessToken' => $this->access_token,
			'expiresIn'  => $this->expires_in,
		];
    }
}
