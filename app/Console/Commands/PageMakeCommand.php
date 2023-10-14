<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\Concerns\CreatesMatchingTest;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;

#[AsCommand(name: 'app:make:crud', description: 'Create a CRUD page for InertiaJS')]
class PageMakeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:make:crud {name : The name of the Resource} {model : The name of the Model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a CRUD page for InertiaJS';

    /**
     * Filesystem instance
     * @var Filesystem
     */
    protected Filesystem $files;

    /**
     * Create a new command instance.
     * @param Filesystem $files
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }


    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->getStubVariable('NAME');

        $this->createController($name);
        $this->createPages($name);
    }

    private function createController(string $namespacedName): void
    {
        $this->createFile($this->getControllerPath($namespacedName . 'Controller'), 'page-controller', $this->getStubVariables());
    }

    private function createPages(string $namespacedName): void
    {
        $className = $this->getStubVariable('CLASS_NAME');
        $this->createFile($this->getPagePath($className . 'Create.tsx'), 'page-view-create', $this->getStubVariables());
        $this->createFile($this->getPagePath($className . 'Edit.tsx'), 'page-view-edit', $this->getStubVariables());
        $this->createFile($this->getPagePath($className . 'List.tsx'), 'page-view-list', $this->getStubVariables());
        $this->createFile($this->getPagePath($className . 'View.tsx'), 'page-view-view', $this->getStubVariables());
    }

    private function createFile(string $path, string $stubName, array $replacements): void
    {
        try {
            // We will check to see if the class already exists. If it does, we don't want
            // to create the class and overwrite the user's code. So, we will bail out so the
            // code is untouched. Otherwise, we will continue generating this class' files.
            if ($this->files->exists($path)) {
                $this->components->error($path . ' already exists.');
                return;
            }

            // Next, we will generate the path to the location where this class' file should get
            // written. Then, we will build the class and make the proper replacements on the
            // stub files so that it gets the correctly formatted namespace and class name.
            $this->makeDirectory(dirname($path));
            $this->files->put($path, $this->getStubContents($this->resolveStubPath($stubName), $replacements));

            $this->components->info(sprintf('%s [%s] created successfully.', Str::title($stubName), $path));
        } catch (FileNotFoundException $e) {
            $this->components->error($e->getMessage());
        }
    }

    /**
     * Build the directory for the class if necessary.
     */
    protected function makeDirectory(string $path): string
    {
        if (!$this->files->isDirectory($path)) {
            $this->files->makeDirectory($path, 0777, true, true);
        }

        return $path;
    }


    /**
     * Replace the stub variables(key) with the desire value
     * @throws FileNotFoundException
     */
    public function getStubContents(string $stub, array $stubVariables = []): array|bool|string
    {
        $contents = $this->files->get($stub);

        foreach ($stubVariables as $search => $replace) {
            $contents = str_replace('{{' . $search . '}}', $replace, $contents);
        }

        return $contents;

    }

    function getStubVariable(string $name): string
    {
        return $this->getStubVariables()[$name];
    }

    public function getStubVariables(): array
    {
        $name = trim($this->getNameArg());
        $className = last(explode('\\', $name));

        return [
            'NAME' => $name,
            'CLASS_NAME' => $className,
            'CONTROLLER_CLASS_NAME' => $className . 'Controller',
            'CONTROLLER_NAMESPACE' => $this->getNamespace($name, 'App\Http\Controllers\\'),
            'PAGES_PATH' => $this->getPagePath($name),
            'MODEL_NAME' => trim($this->argument('model') ?? ''),
        ];
    }

    function resolveStubPath(string $stubName): string
    {
        return __DIR__ . '/../stubs/' . $stubName . '.stub';
    }

    private function getControllerPath(string $name): string
    {
        $controllerNamespace = $this->getNamespace($name, 'App\Http\Controllers\\');
        $name = Str::finish($controllerNamespace, '\\') . $this->getStubVariable('CONTROLLER_CLASS_NAME');
        return base_path(str_replace('\\', '\\', $name) . '.php');
    }

    private function getPagePath(string $fileName): string
    {
        return $this->getBasePagePath() . $this->getNameArg() . '\\' . $fileName;
    }

    private function getBasePagePath(): string
    {
        return resource_path('\\js\\Pages\\');
    }

    /**
     * Get the full namespace for a given class, without the class name.
     *
     */
    protected function getNamespace(string $name, $rootNamespace = ''): string
    {
        return $rootNamespace . trim(implode('\\', array_slice(explode('\\', $name), 0, -1)), '\\');
    }


    function getNameArg(): string
    {
        return trim(str_replace('/', '\\', trim($this->argument('name'))));

    }
}
