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
    	$validated = $request->validated();

		$account = $this->account->create($validated);

		return $account;
    }

	public function show(int $id)
	{
		$account = $this->account->show($id);

		return $account;
	}

	public function update(AccountUpdateRequest $request, int $id)
	{
		$validated = $request->validated();

		$account = $this->account->update($id, $validated);

		return $account;
	}
}