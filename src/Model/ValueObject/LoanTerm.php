<?php

namespace PragmaGoTech\Interview\Model\ValueObject;

class LoanTerm
{
    private int $term;

    private const VALID_TERMS = [12, 24]; // Można rozszerzyć w przyszłości

    public function __construct(int $term)
    {
        if (!in_array($term, self::VALID_TERMS, true)) {
            throw new \InvalidArgumentException("Invalid loan term. Allowed terms are: " . implode(", ", self::VALID_TERMS));
        }

        $this->term = $term;
    }

    public function value(): int
    {
        return $this->term;
    }
}
