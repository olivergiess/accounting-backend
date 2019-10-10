<?php

namespace App\Components\Base\Contracts\Repositories;

interface BaseRepository
{
	public function expand(string $expansions);

	public function all(array $where);

    public function create(array $data);

    public function show(int $id);

    public function update(int $id, array $data);
}
