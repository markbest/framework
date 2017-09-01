<?php

namespace Component\Cli;

use Symfony\Component\Console\Application;

class Console
{
    /**
     * Console Application
     * @var Application
     */
    private $application;

    /**
     * Console Commands list
     * @var array
     */
    private $commands = array();

    /**
     * Console constructor.
     * @param \Component\Cli\Kernel $kernel
     */
    public function __construct($commands = []){
        $this->application = new Application();
        if(is_array($commands) && count($commands)){
            foreach($commands as $command){
                $this->commands[] = new $command();
            }
        }
        $this->loadCommands();
    }

    /**
     * Load commands to list
     */
    public function loadCommands(){
        $kernel = new \Component\Cli\Kernel();
        $commands = $kernel->commands;
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
        $this->application->addCommands($this->commands);

        //Run commands
        $this->application->run();
    }
}