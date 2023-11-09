<?php

namespace App\Service;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\RequestStack;

readonly class CartService {

    public function __construct(private ProductRepository $productRepository, private RequestStack $requestStack) {}

    public function add(string $productId, string $action): array {

        $responseJSON = [
            "ok" => false
        ];

        if($product = $this->getProduct($productId)) {

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

            $responseJSON["orderPrice"] = $this->getOrderPriceHT();
            $responseJSON["nbProducts"] = $this->getNbProducts();
            $responseJSON["productQuantity"] = ($cart->$productId ?? 0);
            $responseJSON["productPrice"] = ($responseJSON["productQuantity"] * $product->getUnitPrice());

        }
        return $responseJSON;

    }

    public function getProductsAndQuantity(): array {

        $cart = $this->getCart();

        $products = [];

        foreach($cart as $productId => $quantity) {

            if($product = $this->getProduct($productId)) {

                $products[] = compact("product", "quantity");

            }

        }
        return $products;

    }

    private function getProduct(int $productId): Product|null {

        return $this->productRepository->find($productId);

    }

    public function getNbProducts(): int {

        $cart = $this->getCart();
        $nbProducts = 0;

        foreach($cart as $productId => $quantity) {

            if($this->getProduct($productId)) {
                $nbProducts += $quantity;
            }

        }
        return $nbProducts;

    }

    public function getOrderPriceHT(): float {

        $cart = $this->getCart();
        $priceHT = 0;

        foreach($cart as $productId => $quantity) {

            if($product = $this->getProduct($productId)) {
                $priceHT += $product->getUnitPrice() * $quantity;
            }

        }
        return $priceHT;

    }

    public function getCart(): object {

        return (object) $this->requestStack->getSession()->get("cart", []);

    }

    public function setCart(object $cart): void {

        $this->requestStack->getSession()->set("cart", $cart);

    }
}
