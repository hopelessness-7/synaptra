<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class ModuleMakeController extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-controller {name : The name of the controller} {module : The name of the module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Создать контроллер в модуле';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Controller';

    /**
     * Get the stub file for the generator.
     */
    protected function getStub(): string
    {
        return base_path('stubs/module-controller.stub');
    }

    /**
     * Get the default namespace for the class.
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return "Modules\\{$this->argument('module')}\\Http\\Controllers";
    }

    /**
     * Get the destination class path.
     */
    protected function getPath($name): string
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);
        $path = app_path(str_replace('\\', '/', $name) . '.php');

        $directory = dirname($path);

        if (!file_exists($directory) && !mkdir($directory, 0755, true) && !is_dir($directory)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $directory));
        }

        return $path;
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
}
