<?php

namespace App\Controller\Client;

use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use App\Service\LogisticService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(
    '/',
    name: 'app_client_',
    requirements: ['host' => '%app.host.client%'],
    defaults: ['host' => '%app.host.client%'],
    host: '{host}')
]
class HomeController extends AbstractController
{
    #[Route(name: 'home')]
    public function home(ProductRepository $productRepository, CategoryRepository $categoryRepository): Response
    {
        $bestProductByCategory = [];

        $categories = $categoryRepository->findAll();

        foreach ($categories as $category) {
            $bestProductByCategory[] = $productRepository->findOneBy(['category' => $category->getId()], []);
        }

        $bestSells = $productRepository->findBy([], [], 5);

        return $this->render('client/home/home.html.twig', [
            'bestSells' => $bestSells,
            'bestProductByCategory' => $bestProductByCategory
        ]);
    }
}
