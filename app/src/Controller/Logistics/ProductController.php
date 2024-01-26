<?php

namespace App\Controller\Logistics;

use App\Repository\StockShelfRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/dashboard',
    name: 'app_logistics_',
    requirements: ['host' => '%app.host.logistics%'],
    defaults: ['host' => '%app.host.logistics%'],
    host: '{host}')
]
#[IsGranted('ROLE_LOGISTICS')]
class ProductController extends AbstractController
{
    #[Route('/view/{id}', name: 'product')]
    public function index(int $id, StockShelfRepository $stockShelfRepository): Response
    {
        $products = $stockShelfRepository->findBy(['product' => $id]);

        return $this->render('logistics/product/index.html.twig', [
            'products' => $products,
        ]);
    }
}
