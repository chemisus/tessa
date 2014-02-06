<?php

namespace Test\Tessa;

use PHPUnit_Framework_TestCase;
use Mockery;

class AssetTest extends PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        parent::tearDown();

        Mockery::close();
    }
}
