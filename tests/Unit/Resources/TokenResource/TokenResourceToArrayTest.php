<?php

namespace Tests\Unit\Resources;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\Auth\Http\Resources\TokenResource;

class TokenResourceToArrayTest extends TestCase
{
    use DatabaseMigrations;

    public function testHasAccessToken()
    {
        $token = (object)[
        	'access_token' => 'o12j3rf8a0hsdf82903hasdpoihfaif2-03489h',
			'expires_in' => 600
		];

        $resource = new TokenResource($token);

        $data = $resource->toArray();

        $this->assertArrayHasKey('accessToken', $data);
    }

    public function testAccessTokenIsString()
    {
        $token = (object)[
        	'access_token' => 'o12j3rf8a0hsdf82903hasdpoihfaif2-03489h',
			'expires_in' => 600
		];

        $resource = new TokenResource($token);

        $data = $resource->toArray();

        $this->assertIsString($data['accessToken']);
    }

    public function testHasExpiresIn()
    {
        $token = (object)[
        	'access_token' => 'o12j3rf8a0hsdf82903hasdpoihfaif2-03489h',
			'expires_in' => 600
		];

        $resource = new TokenResource($token);

        $data = $resource->toArray();

        $this->assertArrayHasKey('expiresIn', $data);
    }

    public function testExpiresInIsInt()
    {
        $token = (object)[
        	'access_token' => 'o12j3rf8a0hsdf82903hasdpoihfaif2-03489h',
			'expires_in' => 600
		];

        $resource = new TokenResource($token);

        $data = $resource->toArray();

        $this->assertIsInt($data['expiresIn']);
    }
}
