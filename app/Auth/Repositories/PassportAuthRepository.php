<?php

namespace App\Auth\Repositories;

use App\Auth\Contracts\Repositories\AuthRepository;
use App\Models\User;
use App\Auth\Http\Resources\TokenResource;

class PassportAuthRepository implements AuthRepository
{
	protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function createTokens(string $email, string $password)
	{
		$payload = [
			'username' => $email,
			'password' => $password,
			'scope'    => '',
		];

		$data = $this->request('password', $payload);

		$result = TokenResource::make($data);

		return $result;
	}

	public function refreshToken(string $refreshToken)
	{
		$payload = [
			'refresh_token' => $refreshToken,
		];

		$data = $this->request('refresh_token', $payload);

		$result = TokenResource::make($data);

		return $result;
	}

	private function request($grantType, $data)
	{
		$client = new \GuzzleHttp\Client;

		$payload = [
			'form_params' => array_merge($data, [
				'client_id'     => env('PASSWORD_CLIENT_ID'),
				'client_secret' => env('PASSWORD_CLIENT_SECRET'),
				'grant_type'    => $grantType
			])
		];

		$endpoint = env('APP_URL').'/oauth/token';

		$response = $client->post($endpoint, $payload);

		$body = $response->getBody();

		$data = (object)json_decode($body, true);

		return $data;
	}
}
