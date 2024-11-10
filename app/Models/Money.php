<?php

namespace App\Models;

use App\Enums\Currency;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\MoneyHelper;

class Money extends Model
{
    protected $fillable = ['amount', 'currency'];

    /**
     * Create a new Money object.
     */
    public static function make(float $amount, Currency $currency)
    {
        return new self([
            'amount' => $amount,
            'currency' => $currency->value,
        ]);
    }

    /**
     * Add another Money object.
     */
    public function add(Money $money): Money
    {
        $this->validateCurrency($money);

        $amount = $this->amount + $money->amount;
        return self::make($amount, Currency::from($this->currency));
    }

    /**
     * Subtract another Money object.
     */
    public function subtract(Money $money): Money
    {
        $this->validateCurrency($money);

        $amount = $this->amount - $money->amount;
        return self::make($amount, Currency::from($this->currency));
    }

    /**
     * Multiply by a factor.
     */
    public function multiply(float $factor): Money
    {
        $amount = $this->amount * $factor;
        return self::make($amount, Currency::from($this->currency));
    }

    /**
     * Divide by a factor.
     */
    public function divide(float $divisor): Money
    {
        $amount = $this->amount / $divisor;
        return self::make($amount, Currency::from($this->currency));
    }

    /**
     * Convert this money object to another currency.
     */
    public function convertTo(Currency $currency): Money
    {
        $exchangeRates = config('exchange_rates');

        $rate = $exchangeRates[$currency->value] ?? 1;

        $convertedAmount = $this->amount * $rate;
        return self::make($convertedAmount, $currency);
    }

    /**
     * Apply a discount percentage.
     */
    public function applyDiscount(float $percentage): Money
    {
        $discount = ($this->amount * $percentage) / 100;
        $amount = $this->amount - $discount;
        return self::make($amount, Currency::from($this->currency));
    }

    /**
     * Validate that both Money objects are the same currency.
     */
    private function validateCurrency(Money $money)
    {
        if ($this->currency !== $money->currency) {
            throw new \InvalidArgumentException('Currencies must be the same for this operation.');
        }
    }

    /**
     * Get the currency symbol.
     */
    public function symbol(): ?string
    {
        return Currency::from($this->currency)->symbol();
    }
}
