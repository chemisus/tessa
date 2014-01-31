<?php

namespace Tessa;

class Compiler
{
    /**
     * @var FileWriter
     */
    private $output;

    public function __construct(FileWriter $output)
    {
        $this->output = $output;
    }

    /**
     * @param FileReader[] $inputs
     */
    public function compile($inputs)
    {
        $this->output->open();

        foreach ($inputs as $input) {
            $this->output->write($input->read());
        }

        $this->output->close();
    }
}