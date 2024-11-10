<?php

namespace App\Repositories;

use App\Models\Money;
use App\Models\Currency;

class MoneyRepository implements MoneyRepositoryInterface
{
    public function create(array $data): Money
    {
        return Money::create([
            'amount' => $data['amount'],
            'currency' => $data['currency'],
        ]);
    }

    public function find(int $id): ?Money
    {
        return Money::find($id);
    }

    public function update(int $id, array $data): Money
    {
        $money = $this->find($id);

        if (!$money) {
            throw new \Exception("Money record not found.");
        }

        $money->update([
            'amount' => $data['amount'],
            'currency' => $data['currency'],
        ]);

        return $money;
    }

    public function delete(int $id): bool
    {
        $money = $this->find($id);

        if (!$money) {
            throw new \Exception("Money record not found.");
        }

        return $money->delete();
    }

    public function getAll(): \Illuminate\Database\Eloquent\Collection
    {
        return Money::all();
    }
}
