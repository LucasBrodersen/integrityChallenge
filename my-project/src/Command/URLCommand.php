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
    name: 'app:URL',
    description: 'Save the final URL and the HTTP Headers of a valid URL',
)]
class URLCommand extends Command
{
    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description') // Not needed, left just in case
        ;
    }
    

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');
        $file_headers = @get_headers($arg1);
        
        if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
            die('URL not valid');
        }

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1)); 
            $client = HttpClient::create();
            $response = $client->request('GET', $arg1);
            $content = $response->getContent(); // para aguardar por resposta

            $io->note(sprintf("Status Code: %s", strval($response->getStatusCode())));
            $finalURL = $response->getInfo('url');
            $io->note(sprintf('Final URL: %s', $response->getInfo('url')));
            $test = $response->getHeaders();
            $io->note(sprintf("Total Headers: %d", sizeof($test)));
            ;
            // URL convertidas para base 64 para prevenir erro de caracteres tipo '/' ou '.', entre outros.
            $urlFirstToPost = base64_encode($arg1);
            $urlFinalToPost = base64_encode($finalURL);
            $dateToPost = $test['date'][0];

           

            //fazer post na url
            $client->request('POST', 'http://localhost:8000/request/'.$urlFirstToPost.'/'.$urlFinalToPost.'/'.$dateToPost, []);
            

            //Faz loop nos header para pegar os keys e depois os valores de cada key
            $headervaluepost = "";
            foreach($test as $key => $value)
            {
            $mykey = $key;
            $io->note(sprintf($mykey));
            foreach ($test[$mykey] as $newvar) {
                $io->note(sprintf(strval($newvar)));
                $headervaluepost = strval($newvar);
                $headervaluepost =  base64_encode($headervaluepost);
                $client->request('POST', 'http://localhost:8000/headers/'.$urlFinalToPost.'/'.$mykey.'/'.$headervaluepost, []);
                
               } 
               $io->note(sprintf('**************************************************************************************************'));
            }
            $io->success('URL registered successfully');   
        }

        

        return Command::SUCCESS;
    }
}