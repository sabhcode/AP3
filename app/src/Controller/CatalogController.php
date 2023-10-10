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
    public function index(CategoryRepository $categorie, ProductRepository $product): Response
    {
        // Récupérez les catégories depuis la base de données
        $categories = $categorie->findAll();
        

        return $this->render('catalog/catalog.html.twig', [
            'categories' => $categories,
        ]);
    }
}
