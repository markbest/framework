<?php

namespace Lib\Cli;

class Kernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    public $commands = [
        Generators\Commands\ModelMakeCommand::class,
        Generators\Commands\ControllerMakeCommand::class
    ];
}