<?php

namespace App\Console;

use Component\Cli\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    public $commands = [
        Commands\TestCommand::class
    ];
}
