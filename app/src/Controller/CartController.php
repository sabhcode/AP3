<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    private RequestStack $requestStack;

    public function __construct(RequestStack $requestStack) {
        $this->$requestStack = $requestStack;
    }

    #[Route('/mon-panier', name: 'app_cart')]
    public function viewCart(Session $session, ProductRepository $productRepository): Response
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
