<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\RequestStack;

class CartService {

    public function __construct(private RequestStack $requestStack) {}

    public function add(string $productUuid, string $action) {

        $request = $this->requestStack->getCurrentRequest();

        $session = $request->getSession();

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

        return true;

    }

}
