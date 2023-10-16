<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Model;

use PragmaGoTech\Interview\Model\ValueObject\LoanAmount;
use PragmaGoTech\Interview\Model\ValueObject\LoanTerm;

/**
 * A cut down version of a loan application containing
 * only the required properties for this test.
 */
class LoanProposal
{
    private LoanTerm $term;

    private LoanAmount $amount;

    public function __construct(LoanTerm $term, LoanAmount $amount)
    {
        $this->term = $term;
        $this->amount = $amount;
    }

    /**
     * Term (loan duration) for this loan application
     * in number of months.
     */
    public function term(): LoanTerm
    {
        return $this->term;
    }

    /**
     * Amount requested for this loan application.
     */
    public function amount(): LoanAmount
    {
        return $this->amount;
    }
}
