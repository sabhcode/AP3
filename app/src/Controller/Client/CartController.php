<?php

namespace App\Controller\Client;

use App\Entity\OrderDetail;
use App\Entity\OrderRank;
use App\Entity\OrderUser;
use App\Repository\OrderStateRepository;
use App\Repository\ProductRepository;
use App\Repository\StockWebRepository;
use App\Repository\StoreRepository;
use App\Service\CartService;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route(
    '/mon-panier',
    name: 'app_client_',
    requirements: ['host' => '%app.host.client%'],
    defaults: ['host' => '%app.host.client%'],
    host: '{host}')
]
class CartController extends AbstractController
{
    /**
     * @param CartService $cartService
     * @return Response
     */
    #[Route(name: 'cart')]
    public function viewCart(CartService $cartService): Response
    {
        $products = $cartService->getProductsAndQuantity();

        return $this->render('client/cart/cart.html.twig', [
            'products' => $products
        ]);
    }

    /**
     * @throws \JsonException
     */
    #[Route('/ajout-produit-panier', name: 'add_product_cart')]
    public function addProductCart(Request $request, CartService $cartService): Response
    {
        $productId = trim($request->request->get("productId"));
        $action = trim($request->request->get("action"));

        if(isset($productId, $action)) {

            $response = $cartService->add($productId, $action);

            $formattedData = $this->renderView("client/cart/update_cart.html.twig", [
                'response' => json_decode($response->getContent(), true)
            ]);

            $response->setData(json_decode(htmlspecialchars_decode($formattedData)));

            return $response;

        }
        return $this->redirectToRoute("app_client_cart");
    }

    /**
     * @param CartService $cartService
     * @param StoreRepository $storeRepository
     * @return Response
     */
    #[Route('/passer-commande/livraison', name: 'delivery_choice')]
    #[IsGranted("ROLE_USER")]
    public function deliveryChoice(CartService $cartService, StoreRepository $storeRepository): Response
    {
        if($cartService->getNbProducts() > 0) {

            $stores = $storeRepository->findAll();

            return $this->render('client/cart/place_order.html.twig', [
                'stores' => $stores,
                'tva' => $this->getParameter('app.tva'),
                'shipping_cost' => $this->getParameter('app.shippingcost')
            ]);

        }
        return $this->redirectToRoute('app_client_cart');
    }

    /**
     * @param Request $request
     * @param CartService $cartService
     * @param StoreRepository $storeRepository
     * @param OrderStateRepository $orderStateRepository
     * @param ProductRepository $productRepository
     * @param EntityManagerInterface $entityManager
     * @param $user
     * @param StockWebRepository $stockWebRepository
     * @return Response
     */
    #[Route('/passer-commande', name: 'place_order')]
    #[IsGranted("ROLE_USER")]
    public function placeOrder(Request $request, CartService $cartService, StoreRepository $storeRepository, OrderStateRepository $orderStateRepository, ProductRepository $productRepository, EntityManagerInterface $entityManager, #[CurrentUser] $user, StockWebRepository $stockWebRepository): Response
    {
        $store = trim($request->request->get('store'));
        $street = trim($request->request->get('street'));
        $zipCode = trim($request->request->get('zip-code'));
        $city = trim($request->request->get('city'));

        if(isset($store, $street, $zipCode, $city) && ($cartService->getNbProducts() > 0)) {

            $order = new OrderUser();
            $orderState = $orderStateRepository->find(1);
            $orderRank = new OrderRank();
            $orderRank->setOrder($order);
            $orderRank->setOrderState($orderState);

            $order->setUser($user);
            $order->setTotalPriceHT($cartService->getOrderPriceHT());
            $order->setTax($this->getParameter('app.tva'));
            $order->setProductQuantity(0);

            if($store && (!$street && !$zipCode && !$city)) {

                $_store = $storeRepository->find($store);

                if($_store) {
                    $order->setCity($_store->getCity());
                }

            }

            if(!$store && ($street && $zipCode && $city)) {

                $order->setShippingCost($this->getParameter('app.shippingcost'));
                $order->setTotalPriceHT($order->getTotalPriceHT() + $order->getShippingCost());
                $order->setStreet($street);
                $order->setZipCode($zipCode);
                $order->setCity($city);

            }

            try {

                $cart = $cartService->getCart();

                $productQuantity = 0;

                foreach ($cart as $productId => $quantity) {

                    if($product = $cartService->getProduct($productId)) {

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

                            $productQuantity += $quantity;

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
                $order->setProductQuantity($productQuantity);

                $entityManager->persist($orderRank);
                $entityManager->persist($order);
                $entityManager->flush();

                $response = new Response();

                $response = $cartService->setCart($response, (object) []);
                $response->setContent($this->renderView("client/cart/confirm_order.html.twig", [
                    'order' => $order
                ]));

                return $response;

            } catch (Exception $_) {

                $this->addFlash('error', 'Une erreur est survenue lors de la commande, merci de bien vérifier les coordonnées saisies');

                return $this->redirectToRoute("app_client_delivery_choice");

            }

        }
        return $this->redirectToRoute("app_client_cart");
    }
}
