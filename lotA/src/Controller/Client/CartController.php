<?php

namespace App\Controller\Client;

use App\Repository\ProductRepository;
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
    public function viewCart(Request $request, ProductRepository $productRepository): Response
    {
        $session = $request->getSession();

        $cart = (object) $session->get("cart", []);
        
        $products = [];

        foreach($cart as $productUuid => $quantity) {

            $product = [$productRepository->find($productUuid), $quantity];

            if($product[0]) {
                $products[] = $product;
            }

        }

        return $this->render('client/cart/cart.html.twig', [
            'products' => $products
        ]);
    }

    #[Route('/ajout-produit-panier', name: 'add_product_cart')]
    public function addProductCart(Request $request, CartService $cartService): Response
    {
        $productUuid = $request->get("productUuid");
        $action = $request->get("action");

        if(isset($productUuid, $action)) {

            return new JsonResponse($cartService->add($productUuid, $action));

        }
        return $this->redirectToRoute("app_client_home");
    }
}
