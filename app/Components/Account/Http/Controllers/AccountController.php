<?php

namespace App\Components\Account\Http\Controllers;

use App\Components\Base\Http\Controllers\BaseController;
use App\Traits\Expandable;

use App\Components\Account\Contracts\Repositories\AccountRepository;
use App\Components\Account\Http\Requests\AccountStoreRequest;
use App\Components\Account\Http\Requests\AccountUpdateRequest;
use Illuminate\Http\Request;

class AccountController extends BaseController
{
	use Expandable;

	protected $account;

	public function __construct(AccountRepository $account, Request $request)
	{
		$this->account = $account;

		$this->expand($request, $this->account);
	}

	public function all(Request $request)
	{
		$user_id = $request->user()->id;

		$accounts = $this->account->all(['user_id' => $user_id]);

		return $accounts;
	}

	public function store(AccountStoreRequest $request)
	{
    	$data = $request->validated();

    	$data['user_id'] = $request->user()->id;

		$account = $this->account->create($data);

		return $account;
    }

	public function show(int $id)
	{
		$account = $this->account->show($id);

		return $account;
	}

	public function update(AccountUpdateRequest $request, int $id)
	{
		$data = $request->validated();

		$account = $this->account->update($id, $data);

		return $account;
	}
}
