<?php

use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\Implementation\FeeCalculator;
use PragmaGoTech\Interview\Implementation\Providers\FeeBreakpoints;
use PragmaGoTech\Interview\Model\DTO\FeeResultDTO;
use PragmaGoTech\Interview\Model\LoanProposal;
use PragmaGoTech\Interview\Model\ValueObject\LoanAmount;
use PragmaGoTech\Interview\Model\ValueObject\LoanTerm;

class FeeCalculatorTest extends TestCase
{
    private FeeBreakpoints $provider;

    protected function setUp(): void
    {
        $this->provider = new FeeBreakpoints();
    }

    public function testTwelveMonthsProviderIsSupported(): void
    {
        $provider = $this->provider->getProviderForTerm(12);
        $this->assertTrue($provider->isSupported(12));
    }

    public function testTwentyFourMonthsProviderIsSupported(): void
    {
        $provider = $this->provider->getProviderForTerm(24);
        $this->assertTrue($provider->isSupported(24));
    }

    public function testInvalidTermThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->provider->getProviderForTerm(36);
    }

    public function testFeeInterpolationForTwelveMonths(): void
    {
        $calculator = new FeeCalculator($this->provider);
        $application = new LoanProposal(new LoanTerm(12), new LoanAmount(1500.00));
        $fee = $calculator->calculate($application);
        $this->assertEquals(70.0, $fee->getFee()); // Interpolated value between 50 and 90
    }

    public function testFeeInterpolationForTwentyFourMonths(): void
    {
        $calculator = new FeeCalculator($this->provider);
        $application = new LoanProposal(new LoanTerm(24), new LoanAmount(1500.00));
        $fee = $calculator->calculate($application);
        $this->assertEquals(85.0, $fee->getFee()); // Interpolated value between 70 and 100
    }

    public function testFeeCalculationForTwelveMonths(): void
    {
        $calculator = new FeeCalculator($this->provider);
        $application = new LoanProposal(new LoanTerm(12), new LoanAmount(5000.00));
        $result = $calculator->calculate($application);
        $this->assertInstanceOf(FeeResultDTO::class, $result);
        $this->assertEquals(100.0, $result->getFee());
    }

    public function testFeeCalculationForTwentyFourMonths(): void
    {
        $calculator = new FeeCalculator($this->provider);
        $application = new LoanProposal(new LoanTerm(24), new LoanAmount(5000.00));
        $result = $calculator->calculate($application);
        $this->assertInstanceOf(FeeResultDTO::class, $result);
        $this->assertEquals(200.0, $result->getFee());
    }

}