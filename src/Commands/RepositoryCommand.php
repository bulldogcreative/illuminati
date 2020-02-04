<?php

namespace Bulldog\Illuminati\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class RepositoryCommand extends GeneratorCommand
{
    protected $name = 'make:repository';

    protected $description = 'Create a new repository class';

    protected $type = 'Repository';

    protected function getStub()
    {
        $stub = null;
        if($this->option('interface')) {
            $stub = 'repository-interface.stub';
        } else {
            $stub = 'repository.stub';
        }

        return __DIR__.'/../../stubs/'.$stub;
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Repositories';
    }

    protected function buildClass($name)
    {
        $replace = [
            'DummyNamespace' => $this->laravel->getNamespace(),
            'DummyClass' => class_basename($name),
        ];

        if($this->option('interface')) {
            $replace = array_merge($replace, [
                'DummyRootNamespace' => $this->laravel->getNamespace(),
                'DummyRepoInterface' => class_basename($name).'Interface',
            ]);

            $this->call('make:interface', ['name' => 'Repositories\\'.class_basename($name).'Interface']);
        }

        return str_replace(
            array_keys($replace), array_values($replace), parent::buildClass($name)
        );
    }

    protected function getOptions()
    {
        return [
            ['interface', 'i', InputOption::VALUE_NONE, 'Generate an interface'],
        ];
    }
}
