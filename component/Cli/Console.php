<?php

namespace Component\Cli;

use Component\Cli\Kernel;
use Symfony\Component\Console\Application;

class Console
{
    /**
     * Console Application
     * @var Application
     */
    private $application;

    /**
     * Console kernel
     * @var \Component\Cli\Kernel
     */
    private $kernel;

    /**
     * Console Commands list
     * @var array
     */
    private $commands = array();

    /**
     * Console constructor.
     * @param \Component\Cli\Kernel $kernel
     */
    public function __construct(Kernel $kernel){
        $this->application = new Application();
        $this->kernel = $kernel;
        $this->loadExistCommands();
    }

    /**
     * add default exist commands to list
     */
    public function loadExistCommands(){
        $kernel = new Kernel();
        $commands = $kernel->commands;
        if(count($commands)){
            foreach($commands as $command){
                $this->commands[] = new $command();
            }
        }
    }

    /**
     * Add Console Commands object
     */
    public function addNewCommands(){
        $commands = $this->kernel->commands;
        if(count($commands)){
            foreach($commands as $command){
                $this->commands[] = new $command();
            }
        }
    }

    /**
     * Run console commands
     */
    public function run(){
        //Register commands
        $this->addNewCommands();
        $this->application->addCommands($this->commands);

        //Run commands
        $this->application->run();
    }
}