<?php

namespace App\Ledger\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

use App\Models\User;
use App\Ledger\Contracts\Repositories\LedgerRepository;

class LedgerPolicy
{
    use HandlesAuthorization;

    protected $repository;

    public function __construct(LedgerRepository $repository)
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

    public function update(User $user, int $id)
    {
		return $this->owns($user, $id);
    }

    public function owns(User $user, int $id)
	{
		$ledger = $this->repository->show($id);

        return $user->id == $ledger->account->user_id;
	}
}
