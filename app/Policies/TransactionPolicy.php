<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\User;
use App\Contracts\Repositories\TransactionRepository;

class TransactionPolicy
{
    use HandlesAuthorization;

    protected $repository;

    public function __construct(TransactionRepository $repository)
	{
		$this->repository = $repository;
	}

	public function store(User $user)
    {
        return true;
    }

    public function view(User $user, int $id)
	{
		$transaction = $this->repository->show($id);

        return $user->id == $transaction->debitee->account->user_id;
    }

    public function update(User $user, int $id)
    {
    	$transaction = $this->repository->show($id);

        return $user->id == $transaction->debitee->account->user_id;
    }
}
