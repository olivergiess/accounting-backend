<?php

namespace App\Contracts\Repositories;

interface BaseRepository
{
    public function create(array $data);

    public function show(int $id);

    public function update(int $id, array $data);
}
