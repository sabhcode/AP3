<?php

namespace App\Service;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\RequestStack;

class CartService {

    public function __construct(private ProductRepository $productRepository, private RequestStack $requestStack) {}

    public function add(string $productId, string $action): array {

        $responseJSON = [
            "ok" => false
        ];
        $product = $this->productRepository->find($productId);

        if($product) {

            $cart = $this->getCart();

            if($action === "add" && !$product->getStockWebs()->isEmpty()) {

                if(property_exists($cart, $productId)) {
                    $cart->$productId++;
                } else {
                    $cart->$productId = 1;
                }
                $responseJSON["ok"] = true;

            }
            
            if($action === "remove") {
                $cart->$productId--;
                $responseJSON["ok"] = true;
            }
            
            if($action === "delete" || (property_exists($cart, $productId) && $cart->$productId <= 0)) {
                unset($cart->$productId);
                $responseJSON["ok"] = true;
            }

            $this->setCart($cart);

            $responseJSON["orderPrice"] = $this->formatPrice($this->getOrderPriceHT());
            $responseJSON["nbProducts"] = $this->getNbProducts();
            $responseJSON["productQuantity"] = ($cart->$productId ?? 0);
            $responseJSON["productPrice"] = $this->formatPrice($responseJSON["productQuantity"] * $product->getUnitPrice());

        }
        return $responseJSON;

    }

    public function getProductsAndQuantity(): array {

        $cart = $this->getCart();

        $products = [];

        foreach($cart as $productId => $quantity) {

            $item = (object) [
                "product" => $this->productRepository->find($productId),
                "quantity" => $quantity
            ];

            if(!is_null($item->product)) {
                array_push($products, $item);
            }

        }
        return $products;

    }

    public function getNbProducts(): int {

        $cart = $this->getCart();
        $nbProducts = 0;

        foreach($cart as $productId => $quantity) {

            $product = $this->productRepository->find($productId);

            if($product) {

                $nbProducts += $quantity;

            }

        }
        return $nbProducts;

    }

    public function getOrderPriceHT(): float {

        $cart = $this->getCart();
        $priceHT = 0;

        foreach($cart as $productId => $quantity) {

            $product = $this->productRepository->find($productId);

            if($product) {

                $priceHT += $product->getUnitPrice() * $quantity;

            }

        }
        return $priceHT;

    }

    public function getCart(): object {

        $session = $this->requestStack->getSession();

        return (object) $session->get("cart", []);

    }

    public function setCart(object $cart): void {

        $session = $this->requestStack->getSession();

        $session->set("cart", $cart);

    }

    public function formatPrice(float $price): string {

        $price = strval($price);

        if(!str_contains($price, ".")) {
            $price .= ",00";
        }

        if(preg_match("/[.][0-9]$/", $price)) {
            $price .= "0";
        }

        return str_replace(".", ",", $price) . " €";

    }

}
