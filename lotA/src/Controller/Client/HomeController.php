<?php

namespace App\Controller\Client;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;

#[Route('/', name: 'app_client_', host: '{host}', defaults: ['host' => '%app.host.client%'], requirements: ['host' => '%app.host.client%'])]
class HomeController extends AbstractController
{
    #[Route(name: 'home')]
    public function home(ProductRepository $productRepository, CategoryRepository $categoryRepository): Response
    {
        $bestProductByCategory = [];

        $categories = $categoryRepository->findAll();

        foreach ($categories as $category) {
            $bestProductByCategory[] = $productRepository->findOneBy(['category' => $category->getUuid()], ['nb_sales' => 'DESC']);
        }

        $bestSells = $productRepository->findBy([], ['nb_sales' => 'DESC'], 5);

        return $this->render('home/home.html.twig', [
            'categories' => $categories,
            'bestSells' => $bestSells,
            'bestProductByCategory' => $bestProductByCategory
        ]);
    }
}
