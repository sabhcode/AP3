<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ProductRepository $productRepository, CategoryRepository $categoryRepository): Response
    {

        $categories = $categoryRepository->findAll();

        foreach ($categories as $category) {

            $BestProductByCategory[] = $productRepository->findOneBy(['category' => $category->getUuid()], ['nb_sales' => 'DESC']);

        }

        $bestSells = $productRepository->findBy([], ['nb_sales' => 'DESC'], 5);

        return $this->render('home/index.html.twig', [
            'categories' => $categories,
            'bestSells' => $bestSells,
            'BestProductByCategory' => $BestProductByCategory
        ]);
    }
}