<?php

namespace Lib\Cli;

class Kernel{

    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \Lib\Cli\Commands\ModelMakeCommand::class,
    ];

    /**
     * Get all available command list
     * @return array
     */
    public function getCommandList(){
        $commands = $this->commands;
        $result = [];
        foreach($commands as $command){
            $_command = new $command();
            $_signature = $_command->signature;
            $_description = $_command->description;
            $result[$_signature] = [
                'path' => $command,
                'desc' => $_description
            ];
        }
        return $result;
    }
}