<?php

namespace App\Service;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class CartService {

    public function __construct(private ProductRepository $productRepository, private RequestStack $requestStack) {}

    public function add(string $productUuid, string $action): array {

        $responseJSON = [
            "ok" => false
        ];
        $product = $this->productRepository->find($productUuid);

        if($product) {

            $session = $this->requestStack->getSession();
            $cart = (object) $session->get("cart", []);

            if($action === "add") {

                if(property_exists($cart, $productUuid)) {
                    $cart->$productUuid++;
                } else {
                    $cart->$productUuid = 1;
                }

            }
            
            if($action === "remove") {
                $cart->$productUuid--;
            }
            
            if($action === "delete" || $cart->$productUuid <= 0) {
                unset($cart->$productUuid);
            }

            $session->set("cart", $cart);

            $responseJSON["ok"] = true;
            $responseJSON["qty"] = $this->getNbProducts();

            return $responseJSON;

        }
        return $responseJSON;

    }

    public function getNbProducts(): int {

        $session = $this->requestStack->getSession();
        $cart = (object) $session->get("cart", []);
        $nbProducts = 0;

        foreach($cart as $productUuid => $qty) {

            $product = $this->productRepository->find($productUuid);

            if($product) {

                $nbProducts += $qty;

            }

        }
        return $nbProducts;

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
