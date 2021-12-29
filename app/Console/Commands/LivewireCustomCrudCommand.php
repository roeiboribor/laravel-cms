<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

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

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
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
        // Generate the Livewire View File
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
    }
}
