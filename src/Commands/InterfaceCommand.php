<?php

namespace Bulldog\Illuminati\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class InterfaceCommand extends GeneratorCommand
{
    protected $name = 'make:interface';

    protected $description = 'Create a new interface';

    protected $type = 'Interface';

    protected function getStub()
    {
        return __DIR__.'/../../stubs/interface.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Contracts';
    }

    protected function buildClass($name)
    {
        $replace = [
            'DummyNamespace' => $this->laravel->getNamespace(),
            'DummyClass' => class_basename($name),
        ];

        return str_replace(
            array_keys($replace), array_values($replace), parent::buildClass($name)
        );
    }
}
