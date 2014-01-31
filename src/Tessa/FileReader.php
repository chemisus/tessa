<?php

namespace Tessa;

class FileReader
{
    private $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function read()
    {
        return file_get_contents($this->path);
    }
}