<?php

namespace App\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestCommand extends Command{
    /**
     * command configure
     */
    protected function configure(){
        $this->setName('test:command')
             ->setDescription('Creates a new command.')
             ->setHelp('This command allows you to create a command...');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output){
        $output->writeln('test:command execute');
    }
}