<?php

use PragmaGoTech\Interview\Model\ValueObject\LoanAmount;
use PragmaGoTech\Interview\Model\ValueObject\LoanTerm;

class ValueObjectsTest extends \PHPUnit\Framework\TestCase
{
    public function testValidAmount(): void
    {
        $amount = new LoanAmount(1500.50);
        $this->assertSame(1500.50, $amount->value());
    }

    public function testInvalidAmountBelowRange(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Loan amount must be between 1,000 PLN and 20,000 PLN.");
        new LoanAmount(500);
    }

    public function testInvalidAmountAboveRange(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Loan amount must be between 1,000 PLN and 20,000 PLN.");
        new LoanAmount(25000);
    }

    public function testInvalidAmountDecimalPlaces(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Loan amount can have up to 2 decimal places.");
        new LoanAmount(1500.555);
    }

    public function testValidTerm(): void
    {
        $term = new LoanTerm(12);
        $this->assertSame(12, $term->value());
    }

    public function testInvalidTerm(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid loan term. Allowed terms are: 12, 24");
        new LoanTerm(15);
    }
}