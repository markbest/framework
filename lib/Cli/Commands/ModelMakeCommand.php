<?php

namespace Lib\Cli\Commands;

class ModelMakeCommand{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    public $signature = 'make:model';

    /**
     * The console command description.
     *
     * @var string
     */
    public $description = 'Create a new Eloquent model class';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(){
        echo "make:model command process";
    }
}