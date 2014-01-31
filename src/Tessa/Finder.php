<?php

namespace Tessa;

class Finder
{
    public function find($path)
    {
        return glob($path, GLOB_BRACE);
    }
}
