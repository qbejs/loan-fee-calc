<?php

namespace PragmaGoTech\Interview\Implementation\Providers;

class FeeBreakpoints
{
    private const NAMESPACE = 'PragmaGoTech\\Interview\\Implementation\\Providers\\Breakpoints';
    private const PATH = __DIR__ . '/Breakpoints';
    private array $providers = [];

    /**
     * @throws \ReflectionException
     */
    public function __construct()
    {
        $this->loadProviders();
    }

    public function getProviderForTerm(int $term): FeeBreakpointsProviderInterface
    {

        foreach ($this->providers as $provider) {
            if ($provider->isSupported($term)) {
                return $provider;
            }
        }

        throw new \InvalidArgumentException("No provider available for term: {$term}");
    }

    /**
     * @throws \ReflectionException
     */
    private function loadProviders(): void
    {
        try {
            foreach (new \DirectoryIterator(self::PATH) as $file) {
                if (!$file->isDot() && $file->isFile() && $file->getExtension() === 'php') {
                    $className = self::NAMESPACE . '\\' . $file->getBasename('.php');
                    $reflectionClass = new \ReflectionClass($className);

                    if ($reflectionClass->implementsInterface(FeeBreakpointsProviderInterface::class) && !$reflectionClass->isAbstract()) {
                        $this->providers[] = new $className();
                    }

                }
            }
        } catch (\Throwable $e) {
            throw new \RuntimeException("Failed to load providers: {$e->getMessage()} Line: {$e->getLine()} File: {$e->getFile()}");
        }
    }

}
