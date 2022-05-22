<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\FinalHeaders;
use Doctrine\Persistence\ManagerRegistry;


class HeadersController extends AbstractController
{
    #[Route('/headers/{finalURL}/{headers}/{headerv}', name: 'app_headers')]

public function createProduct(ManagerRegistry $doctrine,$finalURL, $headers, $headerv): Response
    {
    /**
     * @Route("/request", name="create_product")
     */

        $entityManager = $doctrine->getManager();


        

        $product = new FinalHeaders();
        $product->setFinalUrl(base64_decode($finalURL));
        $product->setHeaders($headers); 
        $product->setHeaderValue(base64_decode($headerv)); 

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new headers '.$product->getId());
    }
}
