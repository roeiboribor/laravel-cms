<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;

class LivewireCustomCrudCommand extends Command
{
    /**
     * The name and signature of the console command.
     * Add ? nameOfTheClass? to not require the parameters
     *
     * @var string
     */
    protected $signature = 'make:livewire:crud 
    {nameOfTheClass? : The name of the class.}, 
    {nameOfTheModelClass? : The name of the model class.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a custom livewire CRUD';

    /**
     * Our custom class properties here
     * 
     */
    protected $nameOfTheClass;
    protected $nameOfTheModelClass;
    protected $file;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->file = new Filesystem();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Gather all parameters
        $this->gatherParameters();

        // Generate the Livewire Class File
        $this->generateLivewireCrudClassfile();

        // Generate the Livewire View File
        $this->generateLivewireCrudViewFile();
    }

    /**
     * Gather All Necessary Parameters
     *
     * @return void
     */
    public function gatherParameters()
    {
        $this->nameOfTheClass = $this->argument('nameOfTheClass');
        $this->nameOfTheModelClass = $this->argument('nameOfTheModelClass');

        // If you didn't input the name of the class
        if (!$this->nameOfTheClass) {
            $this->nameOfTheClass = $this->ask('Enter class name');
        }

        if (!$this->nameOfTheModelClass) {
            $this->nameOfTheModelClass = $this->ask('Enter model name');
        }

        // Convert to studlycase
        $this->nameOfTheClass = Str::studly($this->nameOfTheClass);
        $this->nameOfTheModelClass = Str::studly($this->nameOfTheModelClass);

        // Like Console log the data.
        // $this->info($this->nameOfTheClass . ' - ' . $this->nameOfTheModelClass);
    }

    /**
     * Generate the CRUD class file
     *
     * @return void
     */
    protected function generateLivewireCrudClassfile()
    {
        // Set the origin and desination for the livewire class file
        $fileOrigin = base_path('/stubs/custom.livewire.crud.stub');
        $fileDestination = base_path('/app/Http/Livewire/' . $this->nameOfTheClass . '.php');

        if ($this->file->exists($fileDestination)) {
            $this->info('This class file already exists: ' . $this->nameOfTheClass . '.php');
            return false;
        }

        // Get the original string content of the file.
        $fileOriginalString = $this->file->get($fileOrigin);

        // Replace the strings specified in the array sequentially
        $replaceFileOriginalString = Str::replaceArray(
            '{{}}',
            [
                $this->nameOfTheModelClass,
                $this->nameOfTheClass,
                $this->nameOfTheModelClass,
                $this->nameOfTheModelClass,
                $this->nameOfTheModelClass,
                $this->nameOfTheModelClass,
                $this->nameOfTheModelClass,
                Str::kebab($this->nameOfTheClass) // From "FooBar" to "foo-bar"
            ],
            $fileOriginalString
        );
        // Put the content into the destination directory
        $this->file->put($fileDestination, $replaceFileOriginalString);

        $this->info('Livewire class file created: ' . $fileDestination);
    }

    protected function generateLivewireCrudViewFile()
    {
        // Set the origin and desination for the livewire class file
        $fileOrigin = base_path('/stubs/custom.livewire.crud.view.stub');
        $fileDestination = base_path('/resources/views/livewire/' . Str::kebab($this->nameOfTheClass) . '.blade.php');

        if ($this->file->exists($fileDestination)) {
            $this->info('This view file already exists: ' . Str::kebab($this->nameOfTheClass) . '.blade.php');
            return false;
        }

        // Copy the file to destination
        $this->file->copy($fileOrigin, $fileDestination);
        $this->info('Livewire view file created: ' . $fileDestination);
    }
}
