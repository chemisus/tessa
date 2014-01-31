<?php

namespace Test\Tessa;

use Mockery;
use PHPUnit_Framework_TestCase;
use Tessa\Compiler;

class CompilerTest extends PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        parent::tearDown();

        Mockery::close();
    }

    public function testEmptyCompile()
    {
        $file_writer = Mockery::mock('Tessa\FileWriter');
        $file_writer->shouldReceive('open')->once();
        $file_writer->shouldReceive('close')->once();
        $file_writer->shouldReceive('write')->never();

        $compiler = new Compiler($file_writer);

        $compiler->compile([]);
    }

    public function testCompile()
    {
        $read_data = 'some test';

        $file_writer = Mockery::mock('Tessa\FileWriter');
        $file_writer->shouldReceive('open')->once();
        $file_writer->shouldReceive('close')->once();
        $file_writer->shouldReceive('write')->with($read_data)->once();

        $file_reader = Mockery::mock('Tessa\FileReader');
        $file_reader->shouldReceive('read')->once()->andReturn($read_data);

        $file_readers = [$file_reader];

        $compiler = new Compiler($file_writer);

        $compiler->compile($file_readers);
    }
}