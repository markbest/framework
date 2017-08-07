<?php

namespace Lib\Cli\Generators\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ModelMakeCommand extends Command{
    /**
     * command configure
     */
    protected function configure(){
        $this->setName('make:model')
             ->setDescription('Creates a model.')
             ->setHelp('This command allows you to create a model...');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output){
        $output->writeln('Create model successfully');
    }
}