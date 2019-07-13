<?php

namespace App\Transaction\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

use App\Models\User;
use App\Transaction\Contracts\Repositories\TransactionRepository;

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
		return $this->owns($user, $id);
    }

    public function delete(User $user, int $id)
    {
    	return $this->owns($user, $id);
    }

    public function owns(User $user, int $id)
	{
		$transaction = $this->repository->show($id);

        return $user->id == $transaction->debitee->account->user_id;
	}
}
