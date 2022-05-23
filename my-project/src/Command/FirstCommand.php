<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Console\Helper\Table;

// PLEASE DISCONSIDER THIS COMMAND IT WAS JUST USED FOR TESTING AND STUDIES PURPOSE

#[AsCommand(
    name: 'app:firstcommand',
    description: 'Add a short description for your command',
)]
class FirstCommand extends Command
{
    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        } else {
            $io->note(sprintf('You passed no argument'));
            $client = HttpClient::create();
            $response = $client->request('GET', 'http://localhost:8000/teste/1');
            $test = explode(";", $response->getContent());
            /*
            $Headers = array("Header 1");
            $io->horizontalTable($Headers, $test);
            */
            $table = new Table($output);
            $table
                ->setHeaders(['ISBN'])
                ->setRows([ $test ])
            ;
            $table->render();

        }

        if ($input->getOption('option1')) {
            // ...
        }

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
