<?php

namespace App\Controller\Client;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Requirement\Requirement;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    #[Route('/p/{slug}', name: 'app_product', requirements: ['slug' => Requirement::ASCII_SLUG])]
    public function viewProduct($slug, ProductRepository $productRepository): Response
    {
        // Rechercher le produit en fonction du slug saisi
        $product = $productRepository->findOneBy(['slug' => $slug]);

        if (!$product) {
            // Gérer le cas où le produit n'a pas été trouvé
            throw $this->createNotFoundException('Produit non trouvée');
        }

        // Rendre le template en passant le produit
        return $this->render('product/product.html.twig', [
            'product' => $product
        ]);
    }


}