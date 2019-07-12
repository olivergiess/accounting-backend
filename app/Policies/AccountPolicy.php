<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\User;
use App\Contracts\Repositories\AccountRepository;

class AccountPolicy
{
    use HandlesAuthorization;

    protected $repository;

    public function __construct(AccountRepository $repository)
	{
		$this->repository = $repository;
	}

	public function all(User $user)
    {
        return true;
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
		$account = $this->repository->show($id);

        return $user->id == $account->user_id;
	}
}
