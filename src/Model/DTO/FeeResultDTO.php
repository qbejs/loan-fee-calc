<?php

namespace PragmaGoTech\Interview\Model\DTO;

class FeeResultDTO
{
    private float $fee;

    public function __construct(float $fee)
    {
        $this->fee = $fee;
    }

    public function getFee(): float
    {
        return $this->fee;
    }
}
