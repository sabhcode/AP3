<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use App\Service\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    private RequestStack $requestStack;

    public function __construct(RequestStack $requestStack) {
        $this->requestStack = $requestStack;
    }

    #[Route('/mon-panier', name: 'app_cart')]
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

        return $this->render('cart/cart.html.twig', [
            'products' => $products
        ]);
    }

    #[Route('/ajout-produit-panier', name: 'app_add_product_cart')]
    public function addProductCart(Request $request, CartService $cartService): Response
    {
        $productUuid = $request->get("productUuid");
        $action = $request->get("action");

        if(isset($productUuid, $action)) {

            return new JsonResponse($cartService->add($productUuid, $action));

        }
        return $this->redirectToRoute("app_home");
    }
}
