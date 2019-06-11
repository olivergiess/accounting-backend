<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    protected function unauthorizedResponse()
	{
		return response()->json([
			'errors'=>[
				'Unauthorized'
			]
		], 401);
	}
}