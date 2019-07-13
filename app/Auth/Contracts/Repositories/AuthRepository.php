<?php

namespace App\Auth\Contracts\Repositories;

use App\Models\User;

interface AuthRepository
{
	public function __construct(User $model);

	public function createTokens(string $email, string $password);

	public function refreshToken(string $refreshToken);
}
