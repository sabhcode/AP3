<?php

namespace App\Controller\API;

use App\Entity\Credential;
use App\Repository\CredentialRepository;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
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
            ['groups' => 'product:item']
        ), json: true);
    }
}
