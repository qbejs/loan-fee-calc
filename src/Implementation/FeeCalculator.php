<?php

namespace PragmaGoTech\Interview\Implementation;

use PragmaGoTech\Interview\Model\DTO\FeeResultDTO;
use PragmaGoTech\Interview\Implementation\Providers\FeeBreakpoints;
use PragmaGoTech\Interview\Model\LoanProposal;

class FeeCalculator
{
    private FeeBreakpoints $providerSelector;

    public function __construct(FeeBreakpoints $providerSelector)
    {
        $this->providerSelector = $providerSelector;
    }

    public function calculate(LoanProposal $application): FeeResultDTO
    {
        $amountValue = $application->amount()->value();
        $termValue = $application->term()->value();

        $provider = $this->providerSelector->getProviderForTerm($termValue);
        $breakpoints = $provider->getBreakpoints();

        $lowerBound = 0.00;
        $upperBound = (float) max(array_keys($breakpoints));

        foreach ($breakpoints as $breakpoint => $fee) {
            if ($amountValue < $breakpoint) {
                $upperBound = $breakpoint;
                break;
            }
            $lowerBound = $breakpoint;
        }

        $interpolatedFee = $breakpoints[$lowerBound] +
            (($amountValue - $lowerBound) / ($upperBound - $lowerBound)) *
            ($breakpoints[$upperBound] - $breakpoints[$lowerBound]);

        return new FeeResultDTO($this->roundFee($interpolatedFee, $amountValue));
    }

    private function roundFee(float $fee, float $amount): float
    {
        $total = $fee + $amount;
        $remainder = $total % 5;

        if ($remainder == 0) {
            return $fee;
        }

        return $fee + (5 - $remainder);
    }
}
