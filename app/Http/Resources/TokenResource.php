<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TokenResource extends JsonResource
{
    public function toArray($request = FALSE)
    {
        return [
        	'accessToken' => $this->access_token,
			'expiresIn'  => $this->expires_in,
		];
    }
}
