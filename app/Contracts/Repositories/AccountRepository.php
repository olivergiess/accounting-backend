<?php

namespace App\Contracts\Repositories;

interface AccountRepository extends BaseRepository
{
    public function ledgers(int $id);
}
