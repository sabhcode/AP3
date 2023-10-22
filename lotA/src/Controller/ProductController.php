<?php

namespace App\Controller;

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
        // Rechercher la catégorie en fonction du slug saisi
        $product = $productRepository->findOneBy(['slug' => $slug]);

        if (!$product) {
            // Gérer le cas où la catégorie n'a pas été trouvée
            throw $this->createNotFoundException('Catégorie non trouvée');
        }

        // Rendre le template en passant la catégorie
        return $this->render('product/product.html.twig', [
            'product' => $product
        ]);
    }


}