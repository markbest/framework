<?php

namespace App\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateArticleCommand extends Command{
    /**
     * command configure
     */
    protected function configure(){
        $this->setName('app:create-article')
             ->setDescription('Creates a new article.')
             ->setHelp('This command allows you to create a article...');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output){
        $output->writeln('Create article command!');
    }
}