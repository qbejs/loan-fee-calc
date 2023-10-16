<?php

use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\Factory\LoanProposalFactory;
use PragmaGoTech\Interview\Model\LoanProposal;
use PragmaGoTech\Interview\Model\ValueObject\LoanAmount;
use PragmaGoTech\Interview\Model\ValueObject\LoanTerm;

class LoanProposalFactoryTest extends TestCase
{
    public function testCreate(): void
    {
        $factory = new LoanProposalFactory();

        $termValue = 12;
        $amountValue = 2750.0;

        $loanProposal = $factory->create($termValue, $amountValue);

        $this->assertInstanceOf(LoanProposal::class, $loanProposal);
        $this->assertInstanceOf(LoanTerm::class, $loanProposal->term());
        $this->assertInstanceOf(LoanAmount::class, $loanProposal->amount());
        $this->assertSame($termValue, $loanProposal->term()->value());
        $this->assertSame($amountValue, $loanProposal->amount()->value());
    }
}