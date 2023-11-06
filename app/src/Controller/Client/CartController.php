<?php

namespace App\Controller\Client;

use App\Entity\OrderDetail;
use App\Entity\OrderUser;
use DateTime;
use App\Entity\Order;
use App\Service\CartService;
use App\Repository\StoreRepository;
use App\Repository\OrderStateRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

#[Route('/mon-panier', name: 'app_client_', host: '{host}', defaults: ['host' => '%app.host.client%'], requirements: ['host' => '%app.host.client%'])]
class CartController extends AbstractController
{
    #[Route(name: 'cart')]
    public function viewCart(Request $request, CartService $cartService, StoreRepository $storeRepository): Response
    {
        $placeOrder = $request->get("place-order");

        if(isset($placeOrder)) {

            if($this->getUser()) {
            
                $stores = $storeRepository->findAll();

                return $this->render('client/cart/place_order.html.twig', [
                    'stores' => $stores,
                    'TVA' => $this->getParameter('TVA')
                ]);

            }
            return $this->redirectToRoute('app_login');

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
    #[IsGranted("ROLE_USER")]
    public function placeOrder(Request $request, CartService $cartService, StoreRepository $storeRepository, OrderStateRepository $orderStateRepository, ProductRepository $productRepository, EntityManagerInterface $entityManager, #[CurrentUser] $user): Response
    {
        $store = trim($request->get('store'));
        $street = trim($request->get('street'));
        $zipCode = trim($request->get('zip-code'));
        $city = trim($request->get('city'));

        if(isset($store, $street, $zipCode, $city)) {

            $order = new OrderUser();
            $orderState = $orderStateRepository->find(1);

            $order->setOrderState($orderState);
            $order->setUser($user);
            $order->setTotalPriceHT($cartService->getOrderPriceHT());
            $order->setTax($this->getParameter('TVA'));

            if($store && (!$street && !$zipCode && !$city)) {

                $_store = $storeRepository->find($store);

                $order->setCity($_store->getCity());

            }

            if(!$store && ($street && $zipCode && $city)) {

                $order->setStreet($street);
                $order->setZipCode($zipCode);
                $order->setCity($city);

            }

            $entityManager->persist($order);

            // $cart = $cartService->getCart();

            // foreach ($cart as $productId => $quantity) {

            //     $product = $productRepository->find($productId);

            //     if(!is_null($product) && !$product->getStockWebs()->isEmpty()) {

            //         $orderDetail = new OrderDetail();
            //         $orderDetail->setOrder($order);
            //         $orderDetail->setProduct($product);
            //         $orderDetail->setQuantity($quantity);
            //         $orderDetail->setUnitPrice($product->getUnitPrice());

            //         $entityManager->persist($orderDetail);

            //     }

            // }

            $entityManager->flush();

        }
        return $this->redirectToRoute("app_client_home");
    }
}
