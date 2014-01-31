<?php

namespace Tessa;

class FileWriter
{
    private $path;
    private $handle;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function open()
    {
        $this->handle = fopen($this->path, 'w');
    }

    public function close()
    {
        fclose($this->handle);
    }

    public function write($data)
    {
        fwrite($this->handle, $data);
    }
}
