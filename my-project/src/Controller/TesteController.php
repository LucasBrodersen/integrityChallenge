<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Teste;
use Doctrine\Persistence\ManagerRegistry;

class TesteController extends AbstractController
{
    #[Route('/teste/{id}', name: 'app_teste')]

    public function show(ManagerRegistry $doctrine, int $id): Response
    {
        $allColumn = "";
    
        while ($doctrine->getRepository(Teste::class)->find($id)) {
            $product = $doctrine->getRepository(Teste::class)->find($id);
            $allColumn = $allColumn.$product->getColunaum().';';
            $id = $id + 1;
        }
        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        return new Response($allColumn);

        // or render a template
        // in the template, print things with {{ product.name }}
        // return $this->render('product/show.html.twig', ['product' => $product]);
    }


    /*
    public function createProduct(ManagerRegistry $doctrine, $id): Response
    {
        $entityManager = $doctrine->getManager();

        $product = new Teste();

        $testezera = $product->getColunaum('id', '1');

        $db = $this->('database_connection');
        $query = 'select * from <your_table>';
        $sth = $db->prepare($query);
        $sth->execute();
        while($row = $sth->fetch()) {
            // some stuff
        }

    
        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        //$entityManager->flush();
        
        return new Response('Saved new product with id '.$testezera);
    }
    */
}
