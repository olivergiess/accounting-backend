<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;
use App\Base\Contracts\Repositories\BaseRepository;

trait Expandable
{
	public function expand(Request $request, BaseRepository $repository)
	{
		if($expansions = $request->input('expand'))
			$repository->expand($expansions);
	}
}
