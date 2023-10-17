<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/mon-panier', name: 'app_cart')]
    public function index(Session $session, ProductRepository $productRepository): Response
    {
        $cart = $session->get("cart", []);

        $products = [];

        foreach($cart as $productUuid => $quantity) {

            $product = [$productRepository->find($productUuid), $quantity];

            if($product) {
                $products[] = $product;
            }

        }

        return $this->render('cart/index.html.twig', [
            'controller_name' => 'CartController',
        ]);
    }
}
