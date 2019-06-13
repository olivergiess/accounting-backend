<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\AccountRepository;
use App\Http\Requests\AccountStoreRequest;
use App\Http\Requests\AccountUpdateRequest;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
	protected $account;

	public function __construct(AccountRepository $account)
	{
		$this->account = $account;
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