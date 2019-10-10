<?php

namespace Tests\Unit\Resources;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\Models\Account;
use App\Components\Account\Http\Resources\AccountCollection;
use App\Components\Account\Http\Resources\AccountResource;
use Illuminate\Support\Collection;

class AccountCollectionTest extends TestCase
{
	use DatabaseMigrations;

	protected $account;
	protected $collection;

	public function additionalSetUp()
	{
		$this->account = factory(Account::class, 1)->create();

        $this->collection = new AccountCollection($this->account);
	}

    public function testCanBeInstantiated()
    {
        $this->assertInstanceOf(AccountCollection::class, $this->collection);
    }

    public function testResolveIsArray()
    {
       	$result = $this->collection->resolve();

        $this->assertIsArray($result);
    }

    public function testResolveHasData()
    {
        $result = $this->collection->resolve();

        $this->assertArrayHasKey('data', $result);
    }

    public function testResolveDataIsCollection()
    {
        $result = $this->collection->resolve();

        $data = $result['data'];

        $this->assertInstanceOf(Collection::class, $data);
    }

    public function testResolveDataCollectionIsAccountResources()
    {
        $result = $this->collection->resolve();

        $data = $result['data'];

        $first = $data->first();

        $this->assertInstanceOf(AccountResource::class, $first);
    }
}
