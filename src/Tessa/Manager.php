<?php

namespace Tessa;

class Manager
{
    private $configuration;
    private $finder;

    public function __construct(Configuration $configuration, Finder $finder)
    {
        $this->configuration = $configuration;
        $this->finder = $finder;
    }

    public function files()
    {
        $files = [];

        foreach ($this->configuration->paths() as $path) {
            $files = array_merge($files, $this->finder->find($path));
        }

        return $files;
    }
}