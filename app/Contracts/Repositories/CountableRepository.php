<?php

namespace App\Contracts\Repositories;

interface CountableRepository
{
    public function count(): int;
}
