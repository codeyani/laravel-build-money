<?php

namespace App\Http\Controllers;

use App\Services\MoneyService;
use App\Enums\Currency;
use App\Models\Money;
use Illuminate\Http\Request;

class MoneyController extends Controller
{
    protected $moneyService;

    public function __construct(MoneyService $moneyService)
    {
        $this->moneyService = $moneyService;
    }

    public function addMoney()
    {
        $money1 = Money::make(50, Currency::AED);
        $money2 = Money::make(20, Currency::AED);

        $result = $this->moneyService->addMoney($money1, $money2);

        return response()->json([
            'result' => $result->amount,
            'currency' => $result->symbol(),
        ]);
    }

    public function convertAmount()
    {
        $moneyInUSD = Money::make(50, Currency::USD);  // $50 in USD
        $moneyInEUR = $this->moneyService->convertMoney($moneyInUSD, Currency::UZS);  // Convert USD to EUR

        return response()->json([
            'original' => $moneyInUSD->amount . ' ' . $moneyInUSD->symbol(),
            'converted' => $moneyInEUR->amount . ' ' . $moneyInEUR->symbol(),
        ]);
    }

    // Subtract Money
    public function subtractMoney()
    {
        $money1 = Money::make(50, Currency::AED);
        $money2 = Money::make(20, Currency::AED);

        $result = $this->moneyService->subtractMoney($money1, $money2);

        return response()->json([
            'result' => $result->amount,
            'currency' => $result->symbol(),
        ]);
    }

    // Multiply Money
    public function multiplyMoney()
    {
        $money = Money::make(50, Currency::AED);
        $factor = 2;

        $result = $this->moneyService->multiplyMoney($money, $factor);

        return response()->json([
            'result' => $result->amount,
            'currency' => $result->symbol(),
        ]);
    }

    // Divide Money
    public function divideMoney()
    {
        $money = Money::make(50, Currency::AED);
        $divisor = 2;

        $result = $this->moneyService->divideMoney($money, $divisor);

        return response()->json([
            'result' => $result->amount,
            'currency' => $result->symbol(),
        ]);
    }

    // Apply Discount
    public function applyDiscount()
    {
        $money = Money::make(100, Currency::USD);
        $discountPercentage = 10;

        $result = $this->moneyService->applyDiscount($money, $discountPercentage);

        return response()->json([
            'result' => $result->amount,
            'currency' => $result->symbol(),
        ]);
    }

    // Create a new money record
    public function createMoney(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'currency' => 'required|integer',
        ]);

        $money = $this->moneyService->createMoney($request->all());

        return response()->json([
            'message' => 'Money created successfully.',
            'money' => $money
        ]);
    }

    // Get a single money record
    public function getMoney(int $id)
    {
        $money = $this->moneyService->getMoney($id);

        if (!$money) {
            return response()->json(['message' => 'Money not found.'], 404);
        }

        return response()->json($money);
    }

    // Update a money record
    public function updateMoney(Request $request, int $id)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'currency' => 'required|integer',
        ]);

        try {
            $money = $this->moneyService->updateMoney($id, $request->all());

            return response()->json([
                'message' => 'Money updated successfully.',
                'money' => $money
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }

    // Delete a money record
    public function deleteMoney(int $id)
    {
        try {
            $deleted = $this->moneyService->deleteMoney($id);

            if ($deleted) {
                return response()->json(['message' => 'Money deleted successfully.']);
            }

            return response()->json(['message' => 'Money not found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }

    // Get all money records
    public function getAllMoney()
    {
        $moneyRecords = $this->moneyService->getAllMoney();

        return response()->json($moneyRecords);
    }

}
