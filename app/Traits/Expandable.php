<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Components\Base\Contracts\Repositories\BaseRepository;

trait Expandable
{
	public function expand(Request $request, BaseRepository $repository)
	{
		if($expansions = $request->input('expand'))
			$repository->expand($expansions);
	}
}
