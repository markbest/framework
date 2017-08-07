<?php

namespace Lib\Cli;

use Lib\Cli\Kernel;
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
     * @var \Lib\Cli\Kernel
     */
    private $kernel;

    /**
     * Console Commands list
     * @var array
     */
    private $commands = array();

    /**
     * Console constructor.
     * @param \Lib\Cli\Kernel $kernel
     */
    public function __construct(Kernel $kernel){
        $this->application = new Application();
        $this->kernel = $kernel;
        $this->addExistCommands();
    }

    /**
     * add default exist commands to list
     */
    public function addExistCommands(){
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