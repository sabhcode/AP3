<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class BasketController extends AbstractController
{
    #[Route('/mon-panier', name: 'app_basket')]
    public function index(Session $session, ProductRepository $productRepository): Response
    {
        $basket = $session->get("basket", []);

        $products = [];

        foreach($basket as $productUuid => $quantity) {

            $product = [$productRepository->find($productUuid), $quantity];

            if($product) {
                $products[] = $product;
            }

        }

        return $this->render('basket/index.html.twig', [
            'controller_name' => 'BasketController',
        ]);
    }
}
