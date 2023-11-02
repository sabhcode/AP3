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

            $session = $this->requestStack->getSession();
            $cart = (object) $session->get("cart", []);

            if($action === "add" && !$product->getStocks()->isEmpty()) {

                if(property_exists($cart, $productId)) {
                    $cart->$productId++;
                } else {
                    $cart->$productId = 1;
                }

            }
            
            if($action === "remove") {
                $cart->$productId--;
            }
            
            if($action === "delete" || (property_exists($cart, $productId) && $cart->$productId <= 0)) {
                unset($cart->$productId);
            }

            $session->set("cart", $cart);

            $responseJSON["ok"] = true;
            $responseJSON["orderPrice"] = $this->formatPrice($this->getOrderPriceHT());
            $responseJSON["nbProducts"] = $this->getNbProducts();
            $responseJSON["productQty"] = ($cart->$productId ?? 0);
            $responseJSON["productPrice"] = $this->formatPrice($responseJSON["productQty"] * $product->getUnitPrice());

        }
        return $responseJSON;

    }

    public function getNbProducts(): int {

        $session = $this->requestStack->getSession();
        $cart = (object) $session->get("cart", []);
        $nbProducts = 0;

        foreach($cart as $productId => $qty) {

            $product = $this->productRepository->find($productId);

            if($product) {

                $nbProducts += $qty;

            }

        }
        return $nbProducts;

    }

    public function getOrderPriceHT(): float {

        $session = $this->requestStack->getSession();
        $cart = (object) $session->get("cart", []);
        $priceHT = 0;

        foreach($cart as $productId => $qty) {

            $product = $this->productRepository->find($productId);

            if($product) {

                $priceHT += $product->getUnitPrice() * $qty;

            }

        }
        return $priceHT;

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