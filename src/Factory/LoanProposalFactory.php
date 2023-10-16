<?php

namespace PragmaGoTech\Interview\Factory;

use PragmaGoTech\Interview\Model\LoanProposal;
use PragmaGoTech\Interview\Model\ValueObject\LoanAmount;
use PragmaGoTech\Interview\Model\ValueObject\LoanTerm;

class LoanProposalFactory
{
    public function create(int $termValue, float $amountValue): LoanProposal
    {
        $term = new LoanTerm($termValue);
        $amount = new LoanAmount($amountValue);

        return new LoanProposal($term, $amount);
    }
}
