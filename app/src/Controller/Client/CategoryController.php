<?php

namespace App\Controller\Client;

use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Requirement\Requirement;
use Symfony\Component\Validator\Constraints\Collection;

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
    public function viewAllCategories(CategoryRepository $categoryRepository, ProductRepository $productRepository, Request $request): Response
    {
        // Récupérez les catégories depuis la base de données
        $categories = $categoryRepository->findAll();
        $searchResult = null;

        // Si les paramètres GET 'p' et 'c' ont été saisi alors
        if(!(is_null($request->query->get("p")) && is_null($request->query->get("c")))) {

            $_searchResult = $productRepository->findProductsByCategoryAndName($request->query->get("c"), $request->query->get("p"));

            $searchResult = [];

            foreach($_searchResult as $product) {
                $categoryKey = $product->getCategory()?->getId() . " " . $product->getCategory()?->getName() . " " . $product->getCategory()?->getSlug();
                $searchResult[$categoryKey][] = $product;
            }
            ksort($searchResult);

        }

        // Rendue de la template en passant les paramètres
        return $this->render('client/categories/categories.html.twig', [
            'categories' => $categories,
            'searchResult' => $searchResult
        ]);
    }

    #[Route('/{slug}', name: 'category', requirements: ['slug' => Requirement::ASCII_SLUG])]
    public function viewCategory($slug, CategoryRepository $categoryRepository, ProductRepository $productRepository, Request $request): Response
    {
        // Rechercher la catégorie en fonction du slug saisi
        $category = $categoryRepository->findOneBy(['slug' => $slug]);

        if (!$category) {
            // Gérer le cas où la catégorie n'a pas été trouvée
            throw $this->createNotFoundException('Catégorie non trouvée');
        }

        $searchResult = null;

        if($request->query->get("p")) {
            $searchResult = $productRepository->findProductsByCategoryAndName($category->getId(), $request->query->get("p"));
        }

        // Rendre le template en passant la catégorie
        return $this->render('client/categories/category.html.twig', [
            'category' => $category,
            'searchResult' => $searchResult
        ]);
    }
}
