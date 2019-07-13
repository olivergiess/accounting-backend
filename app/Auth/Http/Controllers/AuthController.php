<?php

namespace App\Auth\Http\Controllers;

use App\Base\Http\Controllers\BaseController;

use App\Auth\Contracts\Repositories\AuthRepository;
use App\Auth\Http\Requests\LoginRequest;
use App\Auth\Http\Requests\RefreshRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class AuthController extends BaseController
{
	protected $user;

	public function __construct(AuthRepository $user)
	{
		$this->user = $user;
	}

    public function login(LoginRequest $request)
	{
		$tokens = $this->user->createTokens($request->email, $request->password);

		$this->__setRefreshTokenCookie($tokens->refresh_token);

		return $tokens;
	}

	public function refresh(RefreshRequest $request)
	{
		$tokens = $this->user->refreshToken($request->refreshToken);

		$this->__setRefreshTokenCookie($tokens->refresh_token);

		return $tokens;
	}

	public function logout(Request $request)
	{
		$request->user()->token()->revoke();
	}

	private function __setRefreshTokenCookie($refreshToken)
	{
		Cookie::queue('refreshToken', $refreshToken, 44640, FALSE, FALSE, FALSE, TRUE);
	}
}
