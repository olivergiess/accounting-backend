<?php

namespace Tests\Unit\Resources;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\Components\Auth\Http\Resources\TokenResource;

class TokenResourceTest extends TestCase
{
    use DatabaseMigrations;

    public function testCanBeInstantiated()
    {
    	$object = new \stdClass();

        $resource = new TokenResource($object);

        $this->assertInstanceOf(TokenResource::class, $resource);
    }
}
