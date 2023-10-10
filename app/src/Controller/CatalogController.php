<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CatalogController extends AbstractController
{
    #[Route('/catalogue', name: 'catalogue')]
    public function index(CategoryRepository $categoryRepository, ProductRepository $productRepository): Response
    {
        // Récupérez les catégories depuis la base de données
        $categories = $categoryRepository->findAll();
        $products = $productRepository->findAll();

        return $this->render('catalog/catalog.html.twig', [
            'categories' => $categories,
            'products' => $products
        ]);
    }
}
