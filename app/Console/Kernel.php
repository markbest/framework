<?php

namespace App\Console;

use Lib\Cli\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    public $commands = [
        Commands\CreateUserCommand::class,
        Commands\CreateArticleCommand::class
    ];
}
