<?php

namespace App\Controller\Client;

use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Requirement\Requirement;

#[Route(
    '/c',
    'app_client_',
    ['host' => '%app.host.client%'],
    defaults: ['host' => '%app.host.client%'],
    host: '{host}')
]
class CategoryController extends AbstractController
{
    #[Route(name: 'categories')]
    public function viewAllCategories(Request $request, CategoryRepository $categoryRepository, ProductRepository $productRepository): Response
    {
        // Récupérez les catégories depuis la bdd
        $categories = $categoryRepository->findAll();
        $searchResult = null;

        // Si les paramètres GET 'p' et 'c' ont été saisi alors
        if(!(is_null($request->query->get('p')))) {

            $productRequest = $request->query->get('p');
            $categoryRequest = $request->query->get('c') ?: '-1';

            $searchResult = $productRepository->findProductsByCategoryAndName($categoryRequest, $productRequest, true);

        }

        // Rendue de la template en passant les paramètres
        return $this->render('client/categories/categories.html.twig', [
            'categories' => $categories,
            'searchResult' => $searchResult
        ]);
    }

    #[Route('/{slug}', name: 'category', requirements: ['slug' => Requirement::ASCII_SLUG])]
    public function viewCategory(Request $request, $slug, CategoryRepository $categoryRepository, ProductRepository $productRepository): Response
    {
        // Rechercher la catégorie en fonction du slug saisi
        $category = $categoryRepository->findOneBy(['slug' => $slug]);

        if (!$category) {
            // Gérer le cas où la catégorie n'a pas été trouvée
            throw $this->createNotFoundException('Catégorie non trouvée');
        }

        $searchResult = null;

        if($productRequest = $request->query->get('p')) {
            $searchResult = $productRepository->findProductsByCategoryAndName($category->getId(), $productRequest);
        }

        // Rendre le template en passant la catégorie
        return $this->render('client/categories/category.html.twig', [
            'category' => $category,
            'searchResult' => $searchResult
        ]);
    }
}
