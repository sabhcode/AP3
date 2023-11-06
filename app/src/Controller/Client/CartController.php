<?php

namespace App\Controller\Client;

use App\Entity\OrderDetail;
use App\Entity\OrderUser;
use App\Entity\StockWeb;
use App\Repository\OrderStateRepository;
use App\Repository\ProductRepository;
use App\Repository\StockWebRepository;
use App\Repository\StoreRepository;
use App\Service\CartService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/mon-panier', name: 'app_client_', host: '{host}', defaults: ['host' => '%app.host.client%'], requirements: ['host' => '%app.host.client%'])]
class CartController extends AbstractController
{
    #[Route(name: 'cart')]
    public function viewCart(Request $request, CartService $cartService, StoreRepository $storeRepository): Response
    {
        $placeOrder = $request->get("place-order");

        if(isset($placeOrder) && $cartService->getNbProducts() > 0) {

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
        return $this->redirectToRoute("app_client_cart");
    }

    #[Route('/passer-commande', name: 'place_order')]
    #[IsGranted("ROLE_USER")]
    public function placeOrder(Request $request, CartService $cartService, StoreRepository $storeRepository, OrderStateRepository $orderStateRepository, ProductRepository $productRepository, EntityManagerInterface $entityManager, #[CurrentUser] $user, StockWebRepository $stockWebRepository): Response
    {
        $store = trim($request->get('store'));
        $street = trim($request->get('street'));
        $zipCode = trim($request->get('zip-code'));
        $city = trim($request->get('city'));

        if($cartService->getNbProducts() > 0) {

            if(isset($store, $street, $zipCode, $city)) {

                $order = new OrderUser();
                $orderState = $orderStateRepository->find(1);

                $order->setOrderState($orderState);
                $order->setUser($user);
                $order->setTotalPriceHT($cartService->getOrderPriceHT());
                $order->setTax($this->getParameter('TVA'));
                $order->setProductQuantity($cartService->getNbProducts());

                if($store && (!$street && !$zipCode && !$city)) {

                    $_store = $storeRepository->find($store);

                    $order->setCity($_store->getCity());

                }

                if(!$store && ($street && $zipCode && $city)) {

                    $order->setTotalPriceHT($order->getTotalPriceHT() + 10);
                    $order->setStreet($street);
                    $order->setZipCode($zipCode);
                    $order->setCity($city);

                }

                $entityManager->persist($order);

                try {
                    
                    $entityManager->persist($order);

                    $cart = $cartService->getCart();

                    foreach ($cart as $productId => $quantity) {

                        $product = $productRepository->find($productId);

                        if(!is_null($product)) {

                            $stockWebs = $stockWebRepository->findBy(["product" => $productId]);
                            $quantityAvailable = 0;

                            foreach($stockWebs as $stockWeb) {
                                $quantityAvailable += $stockWeb->getQuantity();
                            }

                            if($quantityAvailable > $quantity) {

                                $orderDetail = new OrderDetail();
                                $orderDetail->setOrder($order);
                                $orderDetail->setProduct($product);
                                $orderDetail->setQuantity($quantity);
                                $orderDetail->setUnitPrice($product->getUnitPrice());

                                $entityManager->persist($orderDetail);

                                while($quantity > 0) {

                                    foreach($stockWebs as $stockWeb) {

                                        if($stockWeb->getQuantity() > 0) {

                                            $stockWeb->setQuantity($stockWeb->getQuantity() - 1);
                                            $quantity--;

                                            $entityManager->persist($stockWeb);

                                        }

                                    }

                                }

                            }

                        }

                    }

                    $entityManager->flush();
                    $cartService->setCart((object) []);

                    return $this->render("client/cart/confirm_order.html.twig", [
                        'order' => $order
                    ]);

                } catch (\Exception $e) {}

            }

        }
        return $this->redirectToRoute("app_client_cart");
    }
}
