<?php

namespace App\Controller\Client;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Requirement\Requirement;

#[Route('/c', name: 'app_client_', host: '{host}', defaults: ['host' => '%app.host.client%'], requirements: ['host' => '%app.host.client%'])]
class CategoryController extends AbstractController
{
    #[Route(name: 'categories')]
    public function viewAllCategories(CategoryRepository $category): Response
    {
        // Récupérez les catégories depuis la base de données
        $categories = $category->findAll();

        // Rendre le template en passant la catégorie
        return $this->render('client/categories/categories.html.twig', [
            'categories' => $categories
        ]);
    }

    #[Route('/{slug}', name: 'category', requirements: ['slug' => Requirement::ASCII_SLUG])]
    public function viewCategory($slug, CategoryRepository $categoryRepository): Response
    {
        // Rechercher la catégorie en fonction du slug saisi
        $category = $categoryRepository->findOneBy(['slug' => $slug]);

        if (!$category) {
            // Gérer le cas où la catégorie n'a pas été trouvée
            throw $this->createNotFoundException('Catégorie non trouvée');
        }

        // Rendre le template en passant la catégorie
        return $this->render('client/categories/category.html.twig', [
            'category' => $category
        ]);
    }
}
