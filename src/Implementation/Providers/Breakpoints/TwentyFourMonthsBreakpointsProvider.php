<?php

namespace PragmaGoTech\Interview\Implementation\Providers\Breakpoints;

use PragmaGoTech\Interview\Implementation\Providers\FeeBreakpointsProviderInterface;

class TwentyFourMonthsBreakpointsProvider implements FeeBreakpointsProviderInterface
{
    public function getBreakpoints(): array
    {
        return [
            1000 => 70,
            2000 => 100,
            3000 => 120,
            4000 => 160,
            5000 => 200,
            6000 => 240,
            7000 => 280,
            8000 => 320,
            9000 => 360,
            10000 => 400,
            11000 => 440,
            12000 => 480,
            13000 => 520,
            14000 => 560,
            15000 => 600,
            16000 => 640,
            17000 => 680,
            18000 => 720,
            19000 => 760,
            20000 => 800,
        ];
    }

    public function isSupported(int $term): bool
    {
        return $term === 24;
    }
}
