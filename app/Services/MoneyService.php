<?php

namespace App\Services;

use App\Enums\Currency;
use App\Repositories\MoneyRepository;
use App\Models\Money;
use Illuminate\Database\Eloquent\Collection;

class MoneyService
{
    protected $moneyRepository;

    public function __construct(MoneyRepository $moneyRepository)
    {
        $this->moneyRepository = $moneyRepository;
    }
    /**
     * Add two money objects together.
     */
    public function addMoney(Money $money1, Money $money2): Money
    {
        return $money1->add($money2);
    }

    /**
     * Subtract one money object from another.
     */
    public function subtractMoney(Money $money1, Money $money2): Money
    {
        return $money1->subtract($money2);
    }

    /**
     * Multiply a money object by a factor.
     */
    public function multiplyMoney(Money $money, float $factor): Money
    {
        return $money->multiply($factor);
    }

    /**
     * Divide a money object by a divisor.
     */
    public function divideMoney(Money $money, float $divisor): Money
    {
        return $money->divide($divisor);
    }

    /**
     * Apply a discount to a money object.
     */
    public function applyDiscount(Money $money, float $percentage): Money
    {
        return $money->applyDiscount($percentage);
    }

    /**
     * Convert money from one currency to another.
     */
    public function convertMoney(Money $money, Currency $targetCurrency): Money
    {
        return $money->convertTo($targetCurrency);
    }

        /**
     * Create a new money record.
     */
    public function createMoney(array $data): Money
    {
        return $this->moneyRepository->create($data);
    }

    /**
     * Get a money record by ID.
     */
    public function getMoney(int $id): ?Money
    {
        return $this->moneyRepository->find($id);
    }

    /**
     * Update a money record.
     */
    public function updateMoney(int $id, array $data): Money
    {
        return $this->moneyRepository->update($id, $data);
    }

    /**
     * Delete a money record.
     */
    public function deleteMoney(int $id): bool
    {
        return $this->moneyRepository->delete($id);
    }

    /**
     * Get all money records.
     */
    public function getAllMoney(): Collection
    {
        return $this->moneyRepository->getAll();
    }
}
