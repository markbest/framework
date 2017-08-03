<?php

namespace Lib\Cli;

use Lib\Cli\Kernel;

class Cli{
    /**
     * Input cli params
     * @var
     */
    private $args;

    /**
     * @var
     */
    private $kernel;

    /**
     * Cli constructor.
     */
    public function __construct($args){
        $this->args = $args;
        $this->kernel = new Kernel();
    }

    /**
     * Process command
     */
    public function command(){
        switch (count($this->args)){
            case '1':
                $this->displayAllCommands();
                break;
            case '2':
                $args = $this->args;
                if($args['1'] == 'list'){
                    $this->displayAllCommands();
                }else{
                    $commands = $this->getCommandsList();
                    if(isset($commands[$args['1']])){
                        $_cur_command = new $commands[$args['1']]();
                        $_cur_command->handle();
                    }else{
                        $this->displayAllCommands();
                    }
                }
                break;
            default:
                break;
        }
    }

    /**
     * Display all commands list
     * @param $commands
     */
    public function displayAllCommands(){
        $commands = $this->kernel->getCommandList();
        if(count($commands)){
            foreach($commands as $command => $command_info){
                echo $command . ' - ' . $command_info['desc'];
            }
        }
    }

    /**
     * Get commands list
     * @return array
     */
    public function getCommandsList(){
        $result = [];
        $commands = $this->kernel->getCommandList();
        if(count($commands)){
            foreach($commands as $command => $command_info){
                $result[$command] = $command_info['path'];
            }
        }
        return $result;
    }
}