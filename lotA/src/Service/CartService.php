<?php

namespace App\Service;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class CartService {

    private Request $request;

    public function __construct(private ProductRepository $productRepository, RequestStack $requestStack) {
        $this->request = $requestStack->getCurrentRequest();
    }

    public function add(string $productUuid, string $action): array {

        $responseJSON = [
            "ok" => false
        ];

        $product = $this->productRepository->find($productUuid);

        if($product) {

            $session = $this->request->getSession();

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

        $session = $this->request->getSession();

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

}
