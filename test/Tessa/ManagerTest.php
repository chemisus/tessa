<?php

namespace Test\Tessa;

use Mockery;
use PHPUnit_Framework_TestCase;
use Tessa\Manager;

class ManagerTest extends PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        parent::tearDown();

        Mockery::close();
    }

    public function testFind()
    {
        $path = dirname(__DIR__) . 'testdata/*';
        $paths = [$path];
        $files = [dirname(__DIR__) . 'testdata/a', dirname(__DIR__) . 'testdata/b'];
        $expect = [dirname(__DIR__) . 'testdata/a', dirname(__DIR__) . 'testdata/b'];

        $configuration = Mockery::mock('Tessa\Configuration');
        $configuration->shouldReceive('paths')->once()->andReturn($paths);

        $finder = Mockery::mock('Tessa\Finder');
        $finder->shouldReceive('find')->with($path)->once()->andReturn($files);

        $manager = new Manager($configuration, $finder);
        $actual = $manager->files();

        $this->assertEquals($expect, $actual);
    }

    public function testFindMultiple()
    {
        $path1 = dirname(__DIR__) . 'testdata/a/*';
        $path2 = dirname(__DIR__) . 'testdata/b/*';
        $paths = [$path1, $path2];
        $files1 = [dirname(__DIR__) . 'testdata/a/A'];
        $files2 = [dirname(__DIR__) . 'testdata/b/B'];

        $expect = [dirname(__DIR__) . 'testdata/a/A', dirname(__DIR__) . 'testdata/b/B'];

        $configuration = Mockery::mock('Tessa\Configuration');
        $configuration->shouldReceive('paths')->once()->andReturn($paths);

        $finder = Mockery::mock('Tessa\Finder');
        $finder->shouldReceive('find')->with($path1)->once()->andReturn($files1);
        $finder->shouldReceive('find')->with($path2)->once()->andReturn($files2);

        $manager = new Manager($configuration, $finder);
        $actual = $manager->files();

        $this->assertEquals($expect, $actual);
    }
}