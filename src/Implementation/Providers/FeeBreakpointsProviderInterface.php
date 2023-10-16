<?php

namespace PragmaGoTech\Interview\Implementation\Providers;

interface FeeBreakpointsProviderInterface
{
    public function getBreakpoints(): array;
    public function isSupported(int $term): bool;
}
