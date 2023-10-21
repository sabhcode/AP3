<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Requirement\Requirement;

class CategoryController extends AbstractController
{
    #[Route('/c', name: 'app_categories')]
    public function viewAllCategories(CategoryRepository $category): Response
    {
        // Récupérez les catégories depuis la base de données
        $categories = $category->findAll();

        // Rendre le template en passant la catégorie
        return $this->render('categories/categories.html.twig', [
            'categories' => $categories
        ]);
    }

    #[Route('/c/{slug}', name: 'app_category', requirements: ['slug'=> Requirement::ASCII_SLUG])]
    public function viewCategory($slug, CategoryRepository $categoryRepository): Response
    {
        // Rechercher la catégorie en fonction de l'ID
        $category = $categoryRepository->findOneBy(['slug' => $slug]);

        if (!$category) {
            // Gérer le cas où la catégorie n'a pas été trouvée
            throw $this->createNotFoundException('Catégorie non trouvée');
        }

        // Rendre le template en passant la catégorie
        return $this->render('categories/detail.html.twig', [
            'category' => $category
        ]);
    }
}
