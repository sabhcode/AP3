<?php

namespace App\Service;

use App\Entity\Product;
use App\Repository\ProductRepository;
use DateInterval;
use DateTimeImmutable;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;

class CartService {

    public function __construct(private ProductRepository $productRepository,
                                private RequestStack $requestStack,
                                private ParameterBagInterface $params)
    {}

    public function add(string $productId, string $action): JsonResponse {

        $responseJSON = [
            'ok' => false
        ];
        $response = new JsonResponse();

        $product = $this->getProduct($productId);

        if(!$product) {
            return $response->setData($responseJSON);
        }

        $cart = $this->getCart();
        $productAlreadyInCart = property_exists($cart, $productId);

        if($action === 'add' && !$product->getStockShelves()->isEmpty()) {

            if($productAlreadyInCart) {
                $cart->$productId++;
            } else {
                $cart->$productId = 1;
            }
            $responseJSON['ok'] = true;

        }

        if($action === 'remove') {
            $cart->$productId--;
            $responseJSON['ok'] = true;
        }

        if($action === 'delete' || ($productAlreadyInCart && $cart->$productId <= 0)) {
            unset($cart->$productId);
            $responseJSON['ok'] = true;
        }

        if($responseJSON['ok']) {

            $response = $this->setCart($response, $cart);

            $responseJSON['orderPrice'] = $this->getOrderPriceHT($cart);
            $responseJSON['nbProducts'] = $this->getNbProducts($cart);
            $responseJSON['productQuantity'] = ($cart->$productId ?? 0);
            $responseJSON['productPrice'] = ($responseJSON['productQuantity'] * $product->getUnitPrice());

        }
        return $response->setData($responseJSON);
    }

    public function getProductsAndQuantity(): array {

        $cart = $this->getCart();

        $products = [];

        foreach($cart as $productId => $quantity) {

            if($product = $this->getProduct($productId)) {

                $products[] = compact('product', 'quantity');

            }

        }
        return $products;

    }

    public function getProduct(int $productId): Product|null {

        return $this->productRepository->find($productId);

    }

    public function getNbProducts(object $cart = null): int {

        $cart = $cart ?? $this->getCart();
        $nbProducts = 0;

        foreach($cart as $productId => $quantity) {

            if($this->getProduct($productId)) {
                $nbProducts += $quantity;
            }

        }
        return $nbProducts;

    }

    public function getOrderPriceHT(object $cart = null): float {

        $cart = $cart ?? $this->getCart();
        $priceHT = 0;

        foreach($cart as $productId => $quantity) {

            if($product = $this->getProduct($productId)) {
                $priceHT += $product->getUnitPrice() * $quantity;
            }

        }
        return $priceHT;

    }

    public function getCart(): object {

        return (object) json_decode($this->requestStack->getCurrentRequest()->cookies->get('cart'));

    }

    public function setCart(Response $response, object $value): Response {

        $response->headers->setCookie(new Cookie(
            'cart',
            json_encode($value),
            (new DateTimeImmutable())->add(new DateInterval('P1Y')),
            '/',
            $this->params->get('app.host.client')
        ));

        return $response;

    }
}
