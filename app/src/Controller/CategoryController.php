<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Uid\Uuid;

class CategoryController extends AbstractController
{
    #[Route('/catalogue', name: 'catalogue')]
    public function index(CategoryRepository $categorie, ProductRepository $product): Response
    {
        // Récupérez les catégories depuis la base de données
        $categories = $categorie->findAll();

        // Récupérez tous les produits depuis la base de données
        $products = $product->findAll();

        return $this->render('catalogue/catalogue.html.twig', [
            'categories' => $categories,
            'products' => $products,
        ]);
    }
    #[Route('/catalogue/{categoryId}', name: 'category_detail')]
    public function categoryDetail(string $categoryId, CategoryRepository $categoryRepository): Response
    {
        // Rechercher la catégorie en fonction de l'ID
        $category = $categoryRepository->find($categoryId);

        if (!$category) {
            // Gérer le cas où la catégorie n'a pas été trouvée
            throw $this->createNotFoundException('Catégorie non trouvée');
        }

        // Rendre le template en passant la catégorie
        return $this->render('catalogue/detail.html.twig', [
            'category' => $category,
        ]);
    }
}
