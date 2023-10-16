<?php

namespace PragmaGoTech\Interview\Model\ValueObject;

class LoanAmount
{
    private float $amount;

    public function __construct(float $amount)
    {
        if ($amount < 1000 || $amount > 20000) {
            throw new \InvalidArgumentException("Loan amount must be between 1,000 PLN and 20,000 PLN.");
        }

        if (round($amount, 2) !== $amount) {
            throw new \InvalidArgumentException("Loan amount can have up to 2 decimal places.");
        }

        $this->amount = $amount;
    }

    public function value(): float
    {
        return $this->amount;
    }
}
