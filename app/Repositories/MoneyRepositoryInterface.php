<?php

namespace App\Repositories;

use App\Models\Money;
use App\Models\Currency;

interface MoneyRepositoryInterface
{
    public function create(array $data): Money;

    public function find(int $id): ?Money;

    public function update(int $id, array $data): Money;

    public function delete(int $id): bool;

    public function getAll(): \Illuminate\Database\Eloquent\Collection;
}
