<?php

namespace App\Controller\Client;

use App\Repository\StoreRepository;
use App\Service\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/mon-panier', name: 'app_client_', host: '{host}', defaults: ['host' => '%app.host.client%'], requirements: ['host' => '%app.host.client%'])]
class CartController extends AbstractController
{
    #[Route(name: 'cart')]
    public function viewCart(Request $request, CartService $cartService, StoreRepository $storeRepository): Response
    {
        $placeOrder = $request->get("place-order");

        if(isset($placeOrder)) {
            
            $stores = $storeRepository->findAll();

            return $this->render('client/cart/place_order.html.twig', [
                'stores' => $stores,
                'TVA' => $this->getParameter('TVA')
            ]);

        }

        $products = $cartService->getProductsAndQuantity();

        return $this->render('client/cart/cart.html.twig', [
            'products' => $products
        ]);
    }

    #[Route('/ajout-produit-panier', name: 'add_product_cart')]
    public function addProductCart(Request $request, CartService $cartService): Response
    {
        $productId = $request->get("productId");
        $action = $request->get("action");

        if(isset($productId, $action)) {

            return new JsonResponse($cartService->add($productId, $action));

        }
        return $this->redirectToRoute("app_client_home");
    }

    #[Route('/passer-commande', name: 'place_order')]
    public function placeOrder(Request $request, CartService $cartService): Response
    {
        return $this->redirectToRoute("app_client_home");
    }
}
