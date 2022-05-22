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


#[AsCommand(
    name: 'app:CreateUserCommand',
    description: 'Testezera',
)]
class CreateUserCommand extends Command
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
            $client = HttpClient::create();
            $response = $client->request('GET', $arg1);
            $content = $response->getContent(); // para aguardar por resposta
    
            $finalURL = $response->getInfo('url');
            $io->note(sprintf('Final URL: %s', $response->getInfo('url')));
            $test = $response->getHeaders();
            $io->note(sprintf("Headers: %d", sizeof($test)));
            ;
            // URL convertidas para base 64 para prevenir erro de caracteres tipo '/' ou '.', entre outros.
            $urlFirstToPost = base64_encode($arg1);
            $urlFinalToPost = base64_encode($finalURL);
            $dateToPost = $test['date'][0];

           

            //fazer post na url
            $client->request('POST', 'http://localhost:8000/request/'.$urlFirstToPost.'/'.$urlFinalToPost.'/'.$dateToPost, []);
            $io->note(sprintf("Status Code: %s", strval($response->getStatusCode())));

            //Faz loop nos header para pegar os keys e depois os valores de cada key
            $headervaluepost = "";
            foreach($test as $key => $value)
            {
            $mykey = $key;
            $io->note(sprintf($mykey));
            foreach ($test[$mykey] as $newvar) {
                $headervaluepost = strval($newvar);
                $headervaluepost =  base64_encode($headervaluepost);
                $client->request('POST', 'http://localhost:8000/headers/'.$urlFinalToPost.'/'.$mykey.'/'.$headervaluepost, []);
             
               } 
            }   
        } else {
            $io->note(sprintf("Sem argumento"));
        }

        if ($input->getOption('option1')) {
            // ...
        }

        $io->success('Deu certo fei');

        return Command::SUCCESS;
    }
}