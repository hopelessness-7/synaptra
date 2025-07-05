<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;

class ModuleMakeModel extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-model {model : The name of the model} {module : The name of the module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Создать модель в модуле';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Model';

    /**
     * Get the stub file for the generator.
     */
    protected function getStub(): string
    {
        return base_path('stubs/module-model.stub');
    }

    /**
     * Get the default namespace for the class.
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        $module = $this->argument('module');
        return "App\\Modules\\{$module}\\Infrastructure\\Database\\Models";
    }

    /**
     * Get the destination class path.
     */
    protected function getPath($name): string
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);
        return app_path(str_replace('\\', '/', $name) . '.php');
    }

    /**
     * Replace the class name for the given stub.
     */
    protected function replaceClass($stub, $name): array|string
    {
        $class = class_basename($name);
        return str_replace('DummyClass', $class, $stub);
    }

    /**
     * Replace the namespace in the stub.
     */
    protected function replaceNamespace(&$stub, $name): static
    {
        $stub = str_replace('DummyNamespace', $this->getNamespace($name), $stub);
        return $this;
    }

    /**
     * Build the class with the given name.
     */
    protected function buildClass($name): string
    {
        $stub = file_get_contents($this->getStub());
        return $this->replaceNamespace($stub, $name)->replaceClass($stub, $name);
    }


    /**
     * Return the name of the model.
     */
    protected function getNameInput(): string
    {
        return $this->argument('model');
    }

    /**
     * Get the console command arguments.
     */
    protected function getArguments(): array
    {
        return [
            ['model', InputArgument::REQUIRED, 'Имя модели'],
            ['module', InputArgument::REQUIRED, 'Имя модуля'],
        ];
    }
}
