<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Request;
use Doctrine\Persistence\ManagerRegistry;

class RequestController extends AbstractController
{
    #[Route('/request/{firstURL}/{finalURL}/{dateTime}', name: 'app_request')]

public function createProduct(ManagerRegistry $doctrine, $firstURL, $finalURL, $dateTime): Response
    {
    /**
     * @Route("/request", name="create_product")
     */
        $entityManager = $doctrine->getManager();

  
        $product = new Request();
        $product->setFirstURL(base64_decode($firstURL));
        $product->setFinalURL(base64_decode($finalURL)); 
        $product->setDateTime($dateTime); 

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new url with id '.$product->getId());
    }
    
}
