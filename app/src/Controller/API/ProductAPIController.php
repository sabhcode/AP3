<?php

namespace App\Controller\API;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ProductAPIController extends AbstractController
{
    #[Route(
        '/api/categories-products',
        'api_categories_products'
    )]
    public function categoriesProducts(ProductRepository $productRepository, SerializerInterface $serializer): Response
    {
        $result = $productRepository->findProductsByCategoryAndName('-1', '', true);

        return new JsonResponse($serializer->serialize(
            $result,
            'json',
            ['groups' => 'product:list']
        ), json: true);
    }

    #[Route(
        '/api/product/ref',
        'api_product_ref'
    )]
    public function findProductByRef(Request $request, ProductRepository $productRepository, SerializerInterface $serializer): Response
    {
        $supplier = strtoupper(htmlentities($request->get('supplier')));
        $category = strtoupper(htmlentities($request->get('category')));
        $productId = strtoupper(htmlentities($request->get('productId')));

        $product = $productRepository->find($productId);

        if(!$product) {
            return new Response(status: 400);
        }

        $productSupplier = strtoupper(substr($product->getSupplier()->getName(), 0, 3));

        if($productSupplier !== $supplier) {
            return new Response(status: 400);
        }

        $productCategory = strtoupper(substr($product->getCategory()->getSlug(), 0, 3));

        if($productCategory !== $category) {
            return new Response(status: 400);
        }

        $response = $serializer->serialize(
            $product,
            'json',
            ['groups' => 'product:item']
        );

        return new JsonResponse($response, json: true);
    }
}
