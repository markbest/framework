<?php

namespace Lib\Cli\Generators\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Lib\Cli\Generators\Utils\ParseStub;

class ControllerMakeCommand extends Command{
    /**
     * command configure
     */
    protected function configure(){
        // configure an argument
        $this->addArgument('name', InputArgument::REQUIRED, 'The name of the controller.');

        // configure command
        $this->setName('make:controller')
             ->setDescription('Creates a controller.')
             ->setHelp('This command allows you to create a controller...');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output){
        $parseStub = new ParseStub('controller', $input->getArgument('name'));
        $file = $parseStub->make();
        $output->writeln($file . ' create successfully');
    }
}